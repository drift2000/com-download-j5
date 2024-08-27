<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

namespace Sined23\Component\Download\Site\Controller;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class AccessController extends FormController
{
    public function save($key = null, $urlVar = null)
    {
        $this->checkToken();

        $app = $this->app;
        $model = $this->getModel('Access');
        $table = $model->getTable();
        $data = $this->input->post->get('jform', [], 'array');
        $context = "$this->option.edit.$this->context";

        if (empty($key)) {
            $key = $table->getKeyName();
        }

        if (empty($urlVar)) {
            $urlVar = $key;
        }

        $recordId = $this->input->getInt($urlVar);

        $data[$key] = $recordId;

        if (!$model->save($data)) {
            $app->setUserState($context . '.data', $data);

            // Redirect back to the edit screen
            $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()), 'error');

            $this->setRedirect(Route::_('index.php?option=' . $this->option . '&view=access&layout=default' . $this->getRedirectToItemAppend($recordId, $urlVar), false));

            return false;
        }

        $this->setMessage('Form successfully send.');

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $this->sendDataEmail($data);
        $this->setRedirect(Route::_('index.php?option=' . $this->option . '&view=access&layout=send', false));

        return true;
    }

    public function sendDataEmail($data)
    {
        $body_manager = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                            <html xmlns="http://www.w3.org/1999/xhtml">
                            
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>New database access request</title>
                                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                            </head>
                            
                            <body style="margin: 0; padding: 0;">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc; padding: 10px 10px 10px 10px">
                                    <tr>
                                        <td style="padding: 10px 0 10px 0;">
                                        There was a new request for access to ' . $_SESSION['product-info']->category . '.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0 10px 0;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td> Name:  <strong>' . $data['fullname'] . '</strong> </td>
                                                </tr>
                                                <tr>
                                                    <td> Email:  <strong>' . $data['email'] . '</strong> </td>
                                                </tr>
                                                <tr>
                                                    <td>Company:  <strong>' . $data['company'] . '</strong> </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style="padding: 10px 0 0 0;">
                                        <td> Details:</td>
                                    </tr>
                                    <tr>
                                        <td>' . $data['message'] . '</td>
                                    </tr>
                                    <hr>
                                    <tr>
                                        <td>User try to download: ' . $_SESSION['product-info']->product . ' (id=' . $_SESSION['product-info']->cid . ')</td>
                                    </tr>
                                </table>
                            </body>
                            
                            </html>';

        $params = ComponentHelper::getParams('com_download');

        $mailer_m = Factory::getMailer();
        $mailer_m->IsHTML(true);
        $mailer_m->setSender($params->get('noreply_email'), $params->get('noreply_name'));
        $mailer_m->addRecipient($params->get('recipient_email_access'), $params->get('recipient_name_access'));
        if (!empty($params->get('recipient_email_access_bcc'))) {
            $mailer_m->addBcc($params->get('recipient_email_access_bcc'));
        }
        ;
        $mailer_m->addReplyTo($data['email'], $data['fullname']);
        $mailer_m->setSubject("[" . $_SERVER['HTTP_HOST'] . "] " . $params->get('subject_access_manager'));
        $mailer_m->setBody($body_manager);
        $mailer_m->send();

        return true;
    }
}