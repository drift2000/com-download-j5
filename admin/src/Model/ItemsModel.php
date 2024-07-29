<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\Model;

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

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
        $query->order('a.id DESC');

        // Add list ordering clause
        $orderCol = $this->state->get('list.ordering', 'id');
        $orderDirn = $this->state->get('list.direction', 'desc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        // Filter: like / search
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('title LIKE ' . $like);
        }

        // Published filter
        $published = $this->getState('filter.published');
        if (is_numeric($published)) {
            $query->where($db->quoteName('published') . ' = ' . $db->quote($published));
        } elseif ($published === '') {
            $query->whereIn($db->quoteName('published'), array(0, 1));
        }

        return $query;
    }
    public function __construct($config = [])
    {
        $config['filter_fields'] = array(
            'id',
            'a.id',
            'title',
            'a.title',
            'alias',
            'a.alias',
            'published',
            'a.published',
            'created',
            'a.created',
            'modified',
            'a.modified',
            'access',
            'a.access',
            'hits',
            'a.hits',
        );

        parent::__construct($config);
    }
}