<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');
?>
<form action="<?php echo Route::_('index.php?option=com_download&layout=new&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

    <?php echo $this->form->renderField('title'); ?>

    <input type="hidden" name="task" value="item.new" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>