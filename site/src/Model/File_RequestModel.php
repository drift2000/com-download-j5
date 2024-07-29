<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\Model;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\MVC\Model\FormModel;

defined('_JEXEC') or die;

class File_RequestModel extends FormModel
{
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_download.file_request.default',  // just a unique name to identify the form
            'file_request',	    			    // the filename of the XML form definition
                                            // Joomla will look in the models/forms folder for this file
            array(
                'control' => 'jform',	    // the name of the array for the POST parameters
                'load_data' => $loadData	// will be TRUE
            )
        );


        if (empty($form)) {
            $errors = $this->getErrors();
            throw new \Exception(implode("\n", $errors), 500);
        }

        return $form;
    }

}