<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or exit();
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

$data = $this->item;
$download_file_url = "download/" . $data->filename;

echo "<pre>";
// print_r($data);
print_r($data->remote_url);
echo "<br>";
print_r(base64_encode($data->remote_url));
// print_r($data->usergroup);
echo "</pre>";

if ($data->action_id == 0) {
    header("Location: /index.php?option=com_users&view=login&return=" . base64_encode($data->remote_url));
    exit();
}
if ($data->action_id == 1) {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=" . $download_file_url);
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile(filename: $download_file_url);
    // header("Location: /download/" . $data->filename);
    exit();
}
if ($data->action_id == 2 || $data->action_id == 3) {
    $_SESSION['data'] = $data;
    header("Location: /index.php?option=com_download&view=filerequest&layout=default");
    exit();
}
if ($data->action_id == 4) {
    $_SESSION['data'] = $data;
    header("Location: /index.php?option=com_download&view=access&layout=default");
    exit();
}
exit();
