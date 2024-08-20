<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

?>

<form action="<?php echo Route::_('index.php?option=com_download&view=items'); ?>" method="post" name="adminForm" id="adminForm">
    <?php
    // Search tools bar
    // echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]);
    ?>
    <?php if (empty($this->items)): ?>
        <div class="alert alert-info">
            <span class="icon-info-circle" aria-hidden="true"></span>
            <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
        </div>
    <?php else: ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="1%">
                        <?php echo HTMLHelper::_('grid.checkall'); ?>
                    </th>
                    <th>
                        <?php echo Text::_('COM_DOWNLOAD_FILES_STATUS'); ?>
                    </th>
                    <th>
                        <?php echo Text::_('COM_DOWNLOAD_FILES_ITEM_PRODUCT'); ?>
                    </th>
                    <th>
                        <?php echo Text::_('COM_DOWNLOAD_FILES_NUM_COMPNDS'); ?>
                    </th>
                    <th>
                        <?php echo Text::_('COM_DOWNLOAD_FILES_PUBLISH_UP_LABEL'); ?>
                    </th>
                    <th>
                        <?php echo Text::_('COM_DOWNLOAD_FILES_ITEM_USERSGROUP'); ?>
                    </th>
                    <th>
                        <?php echo Text::_('COM_DOWNLOAD_FILES_MANAGER'); ?>
                    </th>
                    <th width="5%">
                        <?php echo Text::_('COM_DOWNLOAD_FILES_ITEM_CID'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $i => $row): ?>
                    <tr>
                        <td>
                            <?php echo HTMLHelper::_('grid.id', $i, $row->id); ?>
                        </td>
                        <td align="center">
                            <?php echo HTMLHelper::_('jgrid.published', $row->published, $i, 'items.', true); ?>
                        </td>
                        <td>
                            <a href="<?php echo Route::_('index.php?option=com_download&task=item.edit&id=' . $row->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape($row->product); ?>">
                                <?php echo $this->escape($row->product); ?>
                            </a>
                            <br>
                            <span style="font-size: calc(1em - 2px); color: grey;">
                                <?php echo $row->group ?> /
                                <?php echo $row->class ?> /
                                <?php echo $row->category ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $row->compounds ?>
                        </td>
                        <td>
                            <?php echo $row->publish_up ?>
                        </td>
                        <td>
                            <?php echo $this->escape($row->access_level); ?>
                        </td>
                        <td>
                            <?php echo $row->user_id ?>
                        </td>
                        <td align="center">
                            <?php echo ($row->cid) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>