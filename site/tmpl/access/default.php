<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$data = $_SESSION['data'] ?? null; 
?>

<div class="container">
    <h1><?php echo Text::_('COM_DOWNLOAD_ACCESS_PAGE_TITLE'); ?></h1>
    <p><?php echo Text::_('COM_DOWNLOAD_ACCESS_PAGE_TEXT'); ?></p>
    <form id="access" action="<?php echo Route::_('index.php'); ?>" method="post" class="form-validate form-horizontal well">
        <div class="row">
            <div class="col">
                <?php echo $this->form->getInput('fullname'); ?>
                <?php
                $this->form->setFieldAttribute('email', 'readonly', 'true', $group = null);
                echo $this->form->getInput('email', '', Factory::getApplication()->getIdentity()->email);
                ?>
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
                <button type="submit" class="btn btn-primary">
                    <?php echo Text::_('COM_DOWNLOAD_FILE_BTN_SEND'); ?>
                </button>

                <?php $_SESSION['send'] = $data; ?>
                <input type="hidden" name="option" value="com_download">
                <input type="hidden" name="task" value="access.save">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </form>
</div>