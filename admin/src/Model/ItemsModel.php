<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class ItemsModel extends ListModel
{

    protected function getListQuery()
    {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);

        // Select statement
        $query->select('*')
            ->from($db->quoteName('#__download_items', 'a'));

        // Order by
        // $query->order('a.cid DESC');
        $query->order('a.id ASC');

        // Published filter
        $published = $this->getState('filter.published');
        if (is_numeric($published)) {
            $query->where($db->quoteName('published') . ' = ' . $db->quote($published));
        } elseif ($published === '') {
            $query->whereIn($db->quoteName('published'), array(0, 1));
        }

        return $query;
    }
}