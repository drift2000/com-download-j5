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
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');
?>

<p><?php echo Text::_('COM_DOWNLOAD_ACCESS_PAGE_TITLE'); ?></p>
<p><?php echo Text::_('COM_DOWNLOAD_ACCESS_PAGE_TEXT'); ?></p>
<form action="<?php echo Route::_('index.php?option=com_download&id=' . (int) $this->item->id); ?>" method="post" class="form-validate form-horizontal well">
    <div class="row">
        <div class="col-md-6">
            <?php echo $this->form->getInput('fullname'); ?>
            <?php
            $this->form->setFieldAttribute('email', 'readonly', 'true', $group = null);
            echo $this->form->getInput('email', '', Factory::getApplication()->getIdentity()->email);
            ?>
            <?php echo $this->form->getInput('company'); ?>
        </div>
        <div class="col-md-6">
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

            <input type="hidden" name="jform[download_file]" value="<?php echo $_SESSION['product-info']->cid; ?>" />
            <input type="hidden" name="jform[page_url]" value="<?php echo Uri::getInstance()->toString(); ?>" />
            <input type="hidden" name="jform[page_name]" value="<?php echo Factory::getApplication()->getDocument()->getTitle(); ?>" />
            <input type="hidden" name="jform[ip]" value="<?php echo Factory::getApplication()->input->server->get('REMOTE_ADDR'); ?>" />
            <input type="hidden" name="option" value="com_download">
            <input type="hidden" name="task" value="access.save">
            <?php echo HTMLHelper::_('form.token'); ?>
        </div>
    </div>
</form>