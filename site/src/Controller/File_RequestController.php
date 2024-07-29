<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\Controller;

use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

class File_RequestController extends BaseController
{
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
}