<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\Model;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;
use Joomla\Database\DatabaseInterface;
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die;

class FileModel extends ItemModel
{
    public function getItem($pk = null)
    {
        /**
         * @var action_id
         * 
         * 0 - guest
         * 1 - download
         * 2 - no file
         * 3 - unpublished
         * 4 - try to download
         * 5 - unknown id
         * 6
         */
        
        $app = Factory::getApplication();
        
        $archiveData = new Registry();
        $archiveData->dtime = date("Y-m-d H:i:s");

        $archiveData->username = $app->getIdentity()->username;
        $archiveData->usergroup = $app->getIdentity()->groups;
        $archiveData->fullname = $app->getIdentity()->name;
        $archiveData->email = $app->getIdentity()->email;

        $archiveData->ip = $app->input->server->get('REMOTE_ADDR');
        $archiveData->remote_url = $app->input->server->get('HTTP_REFERER','','RAW');
        // $archiveData->remove_url = $app->input->server->get('HTTP_REFERER','null','base64');

        /** checking guest/user */
        if ($app->getIdentity()->guest == '1') {
            $archiveData->action_stat = 'guest';
            $archiveData->action_id = '0';
            return $archiveData;
        }

        if ($pk == null) {
            $input = $app->input;
            $pk = $input->get('f', 0, 'int');
        }
        /** select data by id */
        $db = Factory::getContainer()->get(DatabaseInterface::class);
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__download_items'))
            ->where($db->quoteName('cid') . ' = ' . $db->quote($pk));

        $db->setQuery($query);

        $row = $db->loadObject();

        $archiveData->cid = $pk;
        $archiveData->category = $row->category ?? 'unknown';
        $archiveData->class = $row->class ?? 'unknown';
        $archiveData->group = $row->group ?? 'unknown';
        $archiveData->product = $row->product ?? 'unknown';
        $archiveData->type = $row->type ?? 'unknown';
        $archiveData->filename = $row->url ?? 'unknown';
        
        /** check file id */
        if (empty($row)) {
            $archiveData->action_stat = 'unknown id';
            $archiveData->action_id = '5';
            $this->save($archiveData);
            // return array('no_file', $row->emailsend, $row->product);
            return $archiveData;
        }
        /** check if it is published */
        if ($row->published == '0') {
            $archiveData->action_stat = 'unpublished';
            $archiveData->action_id = '3';
            $this->save($archiveData);
            // return array('no_file', $row->emailsend, $row->product);
            return $archiveData;
        }
        /** check the file for existence  */
        if ($row->url == '') {
            $archiveData->action_stat = 'no file';
            $archiveData->action_id = '2';
            $this->save($archiveData);
            // return array('no_file', $row->emailsend, $row->product);
            return $archiveData;
        }
        /** checking the rights */
        if (!array_key_exists($row->access_level, $app->getIdentity()->groups)) {
            $archiveData->action_stat = 'try to download';
            $archiveData->action_id = '4';
            $this->save($archiveData);
            // return array('access', 'error usersgroup');
            return $archiveData;
        }

        $archiveData->action_stat = 'download';
        $archiveData->action_id = '1';
        $this->save($archiveData);
        // return array('file', $row->url);
        return $archiveData;
    }
    public function save($archiveData)
    {
        $this->getDatabase()->insertObject('#__download_stat', $archiveData, 'id');
    }
}