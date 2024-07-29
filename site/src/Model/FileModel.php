<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\Model;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

class FileModel extends ItemModel
{
    public function getItem($pk = null)
    {
        /**
         *  @action status
         *      0 - unknown id; 
         *      1 - download file;
         *      2 - no file to download;
         *      3 - unpublished file;
         *      4 - no right;
         * 
         *  @return array
         */

        /** checking guest/user */
        if (Factory::getApplication()->getIdentity()->guest == '1') {
            return array('guest');
        }

        if ($pk == null) {
            $input = Factory::getApplication()->input;
            $pk = $input->get('f', 0, 'int');
        }

        $db = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__download_items'))
            ->where($db->quoteName('cid') . ' = ' . $db->quote($pk));

        $db->setQuery($query);

        $this->item = $db->loadObject();

        $archiveData = new Registry();
        $archiveData->cid = $pk;
        $archiveData->username = Factory::getApplication()->getIdentity()->username;
        $archiveData->dtime = date("Y-m-d H:i:s");
        $archiveData->category = $this->item->category;
        $archiveData->class = $this->item->class;
        $archiveData->group = $this->item->group;
        $archiveData->product = $this->item->product;
        $archiveData->type = $this->item->type;
        $archiveData->fullname = Factory::getApplication()->getIdentity()->name;
        $archiveData->email = Factory::getApplication()->getIdentity()->email;
        $archiveData->ip = Factory::getApplication()->input->server->get('REMOTE_ADDR');

        $_SESSION['product-info'] = $archiveData;
        // $_SESSION['page-url'] = JFactory::getURI()->toString();
        $_SESSION['page-name'] = Factory::getApplication()->getDocument()->getTitle();

        /**checking id */
        if (empty($db->loadObject())) {
            $archiveData->action_stat = 'unknown id';
            $archiveData->action_id     = '0';
            $this->save($archiveData);
            return array('no_file', $this->item->emailsend, $this->item->product);
        }
        /**checking the rights */
        if (
            array_key_exists($this->item->usersgroup, Factory::getApplication()->getIdentity()->groups) ||
            array_key_exists(6, Factory::getApplication()->getIdentity()->groups) ||
            array_key_exists(7, Factory::getApplication()->getIdentity()->groups) ||
            array_key_exists(8, Factory::getApplication()->getIdentity()->groups)
        ) {
            if ($this->item->published == '1' && $this->item->url !== '') {
                $archiveData->action_stat = 'download';
                $archiveData->action_id     = '1';
                // if ($archiveData->category == 'Compound Libraries') {
                //     $this->sendEmailUser($archiveData);
                // }
                $this->save($archiveData);
                return array('file', $this->item->url);
            }
            ;
            if ($this->item->published == '1' && $this->item->url == '') {
                $archiveData->action_stat = 'no file';
                $archiveData->action_id     = '2';
                $this->save($archiveData);
                return array('no_file', $this->item->emailsend, $this->item->product);
            }
            ;
            if ($this->item->published == '0') {
                $archiveData->action_stat = 'unpublished';
                $archiveData->action_id     = '3';
                $this->save($archiveData);
                return array('no_file', $this->item->emailsend, $this->item->product);
            }
            ;
        } else {
            $archiveData->action_stat = 'try to download';
            $archiveData->action_id     = '4';
            $this->save($archiveData);
            return array('access', 'error usersgroup');
        }

    }
    public function save($archiveData)
    {
        $this->getDatabase()->insertObject('#__download_stat', $archiveData, 'id');
    }
}

