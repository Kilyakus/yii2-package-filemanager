<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    kilyakus\package\filemanager\behaviors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace kilyakus\package\filemanager\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use kilyakus\package\filemanager\models\Mediafile;
use kilyakus\package\filemanager\models\Owners;

class MediafileBehavior extends Behavior
{
    /**
     * @var string owner name
     */
    public $name = '';

    /**
     * @var array owner mediafiles attributes names
     */
    public $attributes = [];

    /**
     * @inheritdoc
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'addOwners',
            ActiveRecord::EVENT_AFTER_UPDATE => 'updateOwners',
            ActiveRecord::EVENT_BEFORE_DELETE => 'deleteOwners',
        ];
    }

    /**
     * Add owners to mediafile
     */
    public function addOwners()
    {
        foreach ($this->attributes as $attr) {
            if ($mediafile = $this->loadModel(['url' => $this->owner->$attr])) {
                $mediafile->addOwner($this->owner->primaryKey, $this->name, $attr);
            }
        }
    }

    /**
     * Update owners of mediafile
     */
    public function updateOwners()
    {
        foreach ($this->attributes as $attr) {
            Mediafile::removeOwner($this->owner->primaryKey, $this->name, $attr);

            if ($mediafile = $this->loadModel(['url' => $this->owner->$attr])) {
                $mediafile->addOwner($this->owner->primaryKey, $this->name, $attr);
            }
        }
    }

    /**
     * Delete owners of mediafile
     */
    public function deleteOwners()
    {
        foreach ($this->attributes as $attr) {
            Mediafile::removeOwner($this->owner->primaryKey, $this->name, $attr);
        }
    }
    
    

    /**
     * Load model by id
     * @param int $id
     * @return Mediafile
     */
    private function loadModel($id)
    {
        return Mediafile::findOne($id);
    }
    
    /**
     * Возвращает ссылку на миниатюру, заданную через аргументы $attribute и $alias
     * @param string $alias Наименование миниатюры, задается в конфигурации filemanager
     * @param bool|string $attribute Наименование атрибута (на случай, если в поведении 
     *                               казано несколько атрибутов)
     * @return bool|string Вернет false, если нет атрибутов или указанный не найден.
     */
    public function imageURL($alias, $attribute = false) {
        if ($attribute && !in_array($attribute, $this->attributes)) {
            return false;
        } elseif ($attribute === false && !($attribute = reset($this->attributes))) {
            return false;
        }
        $owner = Owners::findOne([
            'owner_id' => $this->owner->primaryKey,
            'owner' => $this->name,
            'owner_attribute' => $attribute,
        ]);
        if ($owner instanceof Owners) {
            if ($mediaFile = Mediafile::findOne($owner->mediafile_id)) {
                return $mediaFile->getThumbUrl($alias);
            }
        }
        return false;
    }
}