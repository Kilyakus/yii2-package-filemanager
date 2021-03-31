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
 * @package    kilyakus\package\filemanager\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace kilyakus\package\filemanager\assets;

use yii\web\AssetBundle;

class FileInputAsset extends AssetBundle
{
    public $sourcePath = '@vendor/pendalf89/yii2-filemanager/assets/source';

    public $js = [
        'js/fileinput.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'kilyakus\package\filemanager\assets\ModalAsset',
    ];
}
