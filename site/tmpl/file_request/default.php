<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

// if ($product_info->product !== null) {
//     $filename = $product_info->product;
// } else {
    $filename = "file";
// }
?>

<div class="container">
    <h1>No file or file not published</h1>
    <p>You try to download <b><?php echo $filename; ?></b>, but the file is not available now.<br /> Fill in the form below to send the file request.</p>
    <form id="request" action="<?php echo Route::_('index.php'); ?>" method="post" class="form-validate form-horizontal well">
        <div class="row">
            <div class="col">
                <?php echo $this->form->getInput('fullname'); ?>
                <?php echo $this->form->getInput('email', '', JFactory::getUser()->email); ?>
                <?php echo $this->form->getInput('company'); ?>
            </div>
            <div class="col">
                <?php echo $this->form->getInput('message'); ?>
            </div>
        </div>
        <div>
            <?php
            // echo $this->form->getInput('policy');
            // if ($params->get('policy_name') == "") {
            // 	echo $this->form->getLabel('policy');
            // } else {
            // 	echo $params->get('policy_name');
            // }
            // ;
            ?>
        </div>
        <div class="control-group">
            <div class="controls">
                <!-- <input type="hidden" name="jform[download_file]" value="" /> -->
                <!-- <input type="hidden" name="jform[page_url]" value="<?php // echo Factory::getURI()->toString(); ?>" /> -->
                <!-- <input type="hidden" name="jform[page_name]" value="<?php // echo Factory::getDocument()->getTitle(); ?>" /> -->
                <!-- <input type="hidden" name="task" value="access.save" /> -->
                <!-- <input type="submit" id="btn-export" class="btn_submit" value="Send" /> -->

                <input type="hidden" name="option" value="com_download">
                <input type="hidden" name="task" value="file_request.submit">
                <input type="hidden" name="return" value="<?php echo $this->return_page; ?>">
                <input type="hidden" name="id" value="<?php // echo $this->item->slug; ?>">
                <button type="submit" class="btn btn-primary validate"><?php echo Text::_('COM_DOWNLOAD_FILE_REQUEST_BTN_SEND'); ?></button>

                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </form>
</div>