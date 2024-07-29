<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\View\Item;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

defined('_JEXEC') or die;
class HtmlView extends BaseHtmlView
{
    // protected $form;
    // protected $item;

    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        print_r($this->item);
        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        Factory::getApplication()->getInput()->set('hidemainmenu', true);
        ToolbarHelper::title('Item: Add');

        ToolbarHelper::apply('item.apply');
        ToolbarHelper::save('item.save');
        ToolbarHelper::cancel('item.cancel', 'JTOOLBAR_CLOSE');
    }
}