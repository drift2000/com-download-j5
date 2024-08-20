<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('keepalive')
    ->useScript('form.validate');

?>
<form action="<?php echo Route::_('index.php?option=com_download&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

    <?php echo $this->form->renderField('cid'); ?>
    <?php echo $this->form->renderField('url'); ?>
    <?php echo $this->form->renderField('category'); ?>
    <?php echo $this->form->renderField('class'); ?>
    <?php echo $this->form->renderField('group'); ?>
    <?php echo $this->form->renderField('type'); ?>
    <?php echo $this->form->renderField('product'); ?>
    <?php echo $this->form->renderField('compounds'); ?>

    <?php echo $this->form->renderField('access_level'); ?>
    <?php echo $this->form->renderField('usersgroup'); ?>

    <?php echo $this->form->renderField('emailsend'); ?>

    <?php echo $this->form->renderField('user_id'); ?>
    <?php echo $this->form->renderField('manager'); ?>

    <?php echo $this->form->renderField('published'); ?>
    <?php echo $this->form->renderField('publish_up'); ?>

    <!-- <?php echo LayoutHelper::render('joomla.edit.global', $this); ?> -->

    <!-- <?php echo $this->form->renderField('cid'); ?> -->

    <input type="hidden" name="task" value="" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>