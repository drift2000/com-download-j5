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

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

class ItemModel extends AdminModel
{

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_download.item', 'item', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }
    public function getTable($name = 'Item', $prefix = 'Table', $options = array())
    {
        if ($table = $this->_createTable($name, $prefix, $options)) {
            return $table;
        }
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_download.edit.file.data', []);

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

}