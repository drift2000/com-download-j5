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

$data = $_SESSION['data'] ?? null;
?>

<div class="container">
    <h1><?php echo Text::_('COM_DOWNLOAD_REQUEST_PAGE_TITLE'); ?></h1>
    <p><?php echo Text::_('COM_DOWNLOAD_REQUEST_PAGE_TEXT'); ?></p>
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

                <input type="hidden" name="jform[download_file]" value="<?php echo $data->cid ?? '-1'; ?>" />
                <input type="hidden" name="jform[ip]" value="<?php echo Factory::getApplication()->input->server->get('REMOTE_ADDR'); ?>" />
                <input type="hidden" name="jform[page_url]" value="<?php echo $data->remote_url; ?>" />
                <input type="hidden" name="jform[page_name]" value="<?php // echo Factory::getDocument()->getTitle(); ?>" />
                <input type="hidden" name="return" value="<?php echo $data->remote_url; ?>">
                <input type="hidden" name="option" value="com_download">
                <input type="hidden" name="task" value="filerequest.save">

                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </form>
</div>