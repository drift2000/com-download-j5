<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Administrator\Model;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class ItemModel extends AdminModel
{
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_download.item',
            'item',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_download.edit.item.data', []);

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }
    public function save($data)
    {
        if (empty($data['alias'])) {
            if (Factory::getConfig()->get('unicodeslugs') == 1) {
                $data['alias'] = OutputFilter::stringURLUnicodeSlug($data['title']);
            } else {
                $data['alias'] = OutputFilter::stringURLSafe($data['title']);
            }
        }
        if (!$data['ordering']) {
            $db = Factory::getDbo();
            $query = $db->getQuery(true)
                ->select('MAX(ordering)')
                ->from('#__download_items');

            $db->setQuery($query);
            $max = $db->loadResult();

            $data['ordering'] = $max + 1;
        }
        return parent::save($data);
    }
    public function bind($array, $ignore = '')
    {
        if (isset($array['attribs']) && \is_array($array['attribs'])) {
            $registry = new Registry($array['attribs']);
            $array['attribs'] = (string) $registry;
        }

        return parent::bind($array, $ignore);
    }

    public function check()
    {
        try {
            parent::check();
        } catch (\Exception $e) {
            $this->setError($e->getMessage());

            return false;
        }

        if (trim($this->title) == '') {
            $this->setError('Title (title) is not set.');

            return false;
        }

        if (trim($this->alias) == '') {
            $this->alias = $this->title;
        }

        $this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);

        // Ensure any new items have compulsory fields set
        if (!$this->id) {
            // Hits must be zero on a new item
            $this->hits = 0;
        }

        // Set publish_up to null if not set
        if (!$this->publish_up) {
            $this->publish_up = null;
        }

        // Set publish_down to null if not set
        if (!$this->publish_down) {
            $this->publish_down = null;
        }

        // Check the publish down date is not earlier than publish up.
        if (!is_null($this->publish_up) && !is_null($this->publish_down) && $this->publish_down < $this->publish_up) {
            // Swap the dates
            $temp = $this->publish_up;
            $this->publish_up = $this->publish_down;
            $this->publish_down = $temp;
        }

        return true;
    }
    
    public function store($updateNulls = true)
    {
        $app = Factory::getApplication();
        $date = Factory::getDate()->toSql();
        $user = Factory::getUser();

        if (!$this->created) {
            $this->created = $date;
        }

        if (!$this->created_by) {
            $this->created_by = $user->get('id');
        }

        if ($this->id) {
            // Existing item
            $this->modified_by = $user->get('id');
            $this->modified = $date;
        } else {
            // Set modified to created date if not set
            if (!$this->modified) {
                $this->modified = $this->created;
            }

            // Set modified_by to created_by user if not set
            if (empty($this->modified_by)) {
                $this->modified_by = $this->created_by;
            }
        }

        // Verify that the alias is unique
        $table = $app->bootComponent('download_item')->getMVCFactory()->createTable('Item', 'Administrator');
        if ($table->load(['alias' => $this->alias]) && ($table->id != $this->id || $this->id == 0)) {
            $this->setError('Alias is not unique.');

            if ($table->state == -2) {
                $this->setError('Alias is not unique. The item is in Trash.');
            }

            return false;
        }

        return parent::store($updateNulls);
    }
}