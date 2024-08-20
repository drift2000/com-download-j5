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

defined('_JEXEC') or die;

class FileModel extends ItemModel
{
    public function getItem($pk = null)
    {
        /** checking guest/user */
        if (Factory::getApplication()->getIdentity()->guest == '1') {
            return array('guest');
        }

        if ($pk == null) {
            $input = Factory::getApplication()->input;
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

        /** collect data for stat */
        // $archiveData = array(
        //     'cid' => $pk,
        //     'username' => Factory::getApplication()->getIdentity()->username,
        //     'dtime' => date("Y-m-d H:i:s"),
        //     'category' => (if ($row->category == null) :),
        //     'class' => $row->class,
        //     'group' => $row->group,
        //     'product' => $row->product,
        //     'type' => $row->type,
        //     'fullname' => Factory::getApplication()->getIdentity()->name,
        //     'email' => Factory::getApplication()->getIdentity()->email,
        //     'ip' => Factory::getApplication()->input->server->get('REMOTE_ADDR'),
        // );
        $archiveData = new Registry();
        $archiveData->cid = $pk;
        $archiveData->username = Factory::getApplication()->getIdentity()->username;
        $archiveData->dtime = date("Y-m-d H:i:s");
        $archiveData->category = $row->category;
        $archiveData->class = $row->class;
        $archiveData->group = $row->group;
        $archiveData->product = $row->product;
        $archiveData->type = $row->type;
        $archiveData->fullname = Factory::getApplication()->getIdentity()->name;
        $archiveData->email = Factory::getApplication()->getIdentity()->email;
        $archiveData->ip = Factory::getApplication()->input->server->get('REMOTE_ADDR');

        $_SESSION['product-info'] = $archiveData;
        // $_SESSION['page-url'] = JFactory::getURI()->toString();
        $_SESSION['page-name'] = Factory::getApplication()->getDocument()->getTitle();

        /**checking id */
        if (empty($row)) {
            $archiveData->action_stat = 'unknown id';
            $archiveData->action_id = '0';
            $this->save($archiveData);
            return array('no_file', $row->emailsend, $row->product);
        }

        /**checking the rights */
        if (
            array_key_exists($row->access_level, Factory::getApplication()->getIdentity()->groups) ||
            array_key_exists(6, Factory::getApplication()->getIdentity()->groups) ||
            array_key_exists(7, Factory::getApplication()->getIdentity()->groups) ||
            array_key_exists(8, Factory::getApplication()->getIdentity()->groups)
        ) {
            if ($row->published == '1' && $row->url !== '') {
                $archiveData->action_stat = 'download';
                $archiveData->action_id = '1';
                // if ($archiveData->category == 'Compound Libraries') {
                //     $this->sendEmailUser($archiveData);
                // }
                $this->save($archiveData);
                return array('file', $row->url);
            }
            ;
            if ($row->published == '1' && $row->url == '') {
                $archiveData->action_stat = 'no file';
                $archiveData->action_id = '2';
                $this->save($archiveData);
                return array('no_file', $row->emailsend, $row->product);
            }
            ;
            if ($row->published == '0') {
                $archiveData->action_stat = 'unpublished';
                $archiveData->action_id = '3';
                $this->save($archiveData);
                return array('no_file', $row->emailsend, $row->product);
            }
            ;
        } else {
            $archiveData->action_stat = 'try to download';
            $archiveData->action_id = '4';
            $this->save($archiveData);
            return array('access', 'error usersgroup');
        }

        return $row;
    }
    public function save($archiveData)
    {
        $this->getDatabase()->insertObject('#__download_stat', $archiveData, 'id');
    }
}