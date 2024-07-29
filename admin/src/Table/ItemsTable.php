<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\Table;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

defined('_JEXEC') or die;

class ItemsTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__download_items', 'id', $db);
    }
}