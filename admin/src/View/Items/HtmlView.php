<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\View\Items;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->state = $this->get('State');
        $this->addToolbar();
        $this->pagination = $this->get('Pagination');
        // $this->filterForm = $this->get('FilterForm');
        // $this->activeFilters = $this->get('ActiveFilters');

        // $this->listOrder = $this->escape($this->state->get('list.ordering'));
        // $this->listDirn = $this->escape($this->state->get('list.direction'));

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        ToolbarHelper::title(Text::_('COM_DOWNLOAD_MANAGER_ITEMS'));
        ToolbarHelper::addNew('item.add');
        // ToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'items.delete');
        ToolbarHelper::publish('items.publish', 'JTOOLBAR_PUBLISH', true);
        ToolbarHelper::unpublish('items.unpublish', 'JTOOLBAR_UNPUBLISH', true);
    }
}
