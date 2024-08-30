<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\Model;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Table\Table;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Database\ParameterType;
use Joomla\Registry\Registry;
use Joomla\Utilities\ArrayHelper;

\defined('_JEXEC') or die;

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

        // Filter: like / search
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('product LIKE ' . $like. 'OR cid LIKE ' .$like);
        }

        // Published filter
        $published = $this->getState('filter.published');
        if (is_numeric($published)) {
            $query->where($db->quoteName('published') . ' = ' . $db->quote($published));
        } elseif ($published === '') {
            $query->whereIn($db->quoteName('published'), array(0, 1));
        }

        // Filter by access level.
        $access = $this->getState('filter.access_level');

        if (is_numeric($access)) {
            $access = (int) $access;
            $query->where($db->quoteName('a.access_level') . ' = :access')
                ->bind(':access', $access, ParameterType::INTEGER);
        } elseif (\is_array($access)) {
            $access = ArrayHelper::toInteger($access);
            $query->whereIn($db->quoteName('a.access_level'), $access);
        }

        return $query;
    }
}

