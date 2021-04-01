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
 * @package    kilyakus\package\filemanager\views\file
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
?>
<div role="filemanager-modal" class="modal" tabindex="-1"
     data-frame-id="<?= $frameId ?>"
     data-frame-src="<?= $frameSrc ?>"
     data-btn-id="<?= $btnId ?>"
     data-input-id="<?= $inputId ?>"
     data-image-container="<?= isset($imageContainer) ? $imageContainer : '' ?>"
     data-paste-data="<?= isset($pasteData) ? $pasteData : '' ?>"
     data-thumb="<?= $thumb ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>