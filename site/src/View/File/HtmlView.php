<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\View\File;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{
    protected $item;

    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        $app = Factory::getApplication();
        $active = $app->getMenu()->getActive();
        $this->params = $active->getParams();

        parent::display($tpl);
    }
}