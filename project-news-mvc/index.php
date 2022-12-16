<?php

//session start
session_start();

//helpers
require_once 'helpers/helpers.php';

//app config
require_once 'config/app.php';

// db config
require_once 'config/database.php';

//mail
require_once 'config/mail.php';

// error reporting
displayError(DISPLAY_ERROR);
global $flashMessage;
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

//models
require_once 'app/models/Model.php';
require_once 'app/models/Category.php';
require_once 'app/models/Banner.php';
require_once 'app/models/Menu.php';
require_once 'app/models/User.php';
require_once 'app/models/Comment.php';
require_once 'app/models/Post.php';
require_once 'app/models/Setting.php';

// admin controller
require_once 'app/controllers/Admin/Admin.php';
require_once 'app/controllers/Admin/Category.php';
require_once 'app/controllers/Admin/Post.php';
require_once 'app/controllers/Admin/Banner.php';
require_once 'app/controllers/Admin/User.php';
require_once 'app/controllers/Admin/Comment.php';
require_once 'app/controllers/Admin/Menu.php';
require_once 'app/controllers/Admin/Websetting.php';

//Home
require_once 'app/controllers/App/Home.php';

//auth
require_once 'app/controllers/Auth/Auth.php';

// autoload
spl_autoload_register(function ($className) {
    $path = BASE_PATH . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR;
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    include $path . $className . '.php';
});

require_once 'router/routing.php';

// reserved routes
require_once 'router/web.php';
