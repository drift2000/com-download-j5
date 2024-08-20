<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class FileRequestTable extends Table
{
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__cta_file_request', 'id', $db);
    }
    public function bind($array, $ignore = '')
    {
        if (empty($array['created_by'])) {
            $user = Factory::getApplication()->getIdentity();
            $array['created_by'] = $user->id;
        }
        if (empty($array['created_date'])) {
            $array['created_date'] = date('Y-m-d H:i:s');
        }
        if ((trim($array['message'])) == '') {
            $array['message'] = Text::_('COM_DOWNLOAD_ACCESS_NO_MESSAGE');
        }

        return parent::bind($array, $ignore);
    }
}