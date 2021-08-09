
<?php

defined('DS')? NULL : define('DS', DIRECTORY_SEPARATOR) ; //  Example /
define('SITE_ROOT', DS . 'Applications' . DS .  'MAMP' . DS . 'htdocs' . DS . 'gallery_application'); //  site root
defined('INCLUDES_PATH')? NULL : define('INCLUDES_PATH', SITE_ROOT .DS. 'admin' .DS. 'includes'); //  Includes folder from admin

require_once ("functions.php");
require_once("new_config.php");
require_once ("Database.php");
require_once ("db_object.php");
require_once ("user.php");
require_once ("photo.php");
require_once ("comment.php");
require_once ("Session.php");




