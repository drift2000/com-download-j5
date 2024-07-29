<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\View\File_Request;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        if (!$this->form = $this->get('form')) {
            echo Text::_('COM_DOWNLOAD_FILE_REQUEST_CANT_LOAD_FORM');
            return;
        }
        parent::display($tpl);	// this will include the layout file edit.php
    }
}