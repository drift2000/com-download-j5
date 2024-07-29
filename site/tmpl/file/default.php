<?php

/**
 * @package     Simple Download Component
 * @subpackage  com_download
 *
 * @copyright   Copyright (C) 2024 sined23. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or exit();

if ($this->item[0] == 'file') {

    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=" . $this->item[1]);
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile( $this->item[1]);
    exit();
} elseif ($this->item[0] == 'no_file') {
    header("Location: /index.php?option=com_download&view=file_request");
    exit();
} elseif ($this->item[0] == 'access') {
    header("Location: /index.php?option=com_download&view=access");
    exit();
} elseif ($this->item[0] == 'guest') {
    header("Location: /index.php?option=com_users&view=login");
    exit();
} else {
    exit();
}


// $file = $this->item[1];
// echo $file. "<br/>";
// if (!file_exists($file)) { // file does not exist
//     die('file not found');
// } else {
//     header("Cache-Control: public");
//     header("Content-Description: File Transfer");
//     header("Content-Disposition: attachment; filename=$file");
//     header("Content-Type: application/zip");
//     header("Content-Transfer-Encoding: binary");

//     // read the file from disk
//     readfile($file);
// }



