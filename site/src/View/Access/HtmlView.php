<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\View\Access;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Toolbar\ToolBarHelper;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;
    protected $state;

    public function display($tpl = null)
    {
        // ToolBarHelper::preferences('com_download');
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');
        $this->state = $this->get('State');
        
        // Check for errors.
        // if (\count($errors = $this->get('Errors'))) {
        //     throw new GenericDataException(implode("\n", $errors), 500);
        // }

        parent::display($tpl);
    }
}