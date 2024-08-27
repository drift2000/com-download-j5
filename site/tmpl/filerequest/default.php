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
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$filename = (empty($_SESSION['product-info'])) ? ('') : ($_SESSION['product-info']);
if ($filename == '') {
    $product = 'file';
    $cid = '-1';
} else {
    $product = $filename->product;
    $cid = $filename->cid;
}
?>

<div class="container">
    <!-- <pre><?php print_r($this->item); ?></pre> -->
    <h1>No file or file unpublished</h1>
    <p>You try to download <b><?php echo $product; ?></b>, but the file is not available now.<br /> Fill in the form below to send the file request.</p>
    <form id="request" action="<?php echo Route::_('index.php'); ?>" method="post" class="form-validate form-horizontal well">
        <div class="row">
            <div class="col">
                <?php echo $this->form->getInput('fullname'); ?>
                <?php 
                $this->form->setFieldAttribute('email', 'readonly', 'true', $group = null);
                echo $this->form->getInput('email', '', Factory::getApplication()->getIdentity()->email); ?>
                <?php echo $this->form->getInput('company'); ?>
            </div>
            <div class="col">
                <?php echo $this->form->getInput('message'); ?>
            </div>
        </div>
        <div>
            <?php
            echo $this->form->getInput('policy');
            echo $this->form->getLabel('policy');
            ?>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-primary validate">
                    <?php echo Text::_('COM_DOWNLOAD_FILE_BTN_SEND'); ?>
                </button>

                <input type="hidden" name="jform[download_file]" value="<?php echo $cid ?>" />
                <input type="hidden" name="return" value="<?php echo $this->return_page; ?>">
                <input type="hidden" name="id" value="<?php // echo $this->item->slug; ?>">
                <input type="hidden" name="jform[ip]" value="<?php echo Factory::getApplication()->input->server->get('REMOTE_ADDR'); ?>" />
                <input type="hidden" name="jform[page_url]" value="<?php // echo Factory::getURI()->toString(); ?>" />
                <input type="hidden" name="jform[page_name]" value="<?php // echo Factory::getDocument()->getTitle(); ?>" />
                <input type="hidden" name="option" value="com_download">
                <input type="hidden" name="task" value="filerequest.save">

                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </form>
</div>