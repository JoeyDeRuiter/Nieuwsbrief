<?php
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

/**
 * Autoload class to load the controllers / models
 */
spl_autoload_register(function($class) {
    // Check if the controller exist in the controllers folder
    if(file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . $class . '.php'))
    {
        include ROOT . DS . 'application' . DS . 'controllers' . DS . $class . '.php';
    }

    if(file_exists(ROOT . DS . 'application' . DS . 'models' . DS . $class . '.php'))
    {
        include ROOT . DS . 'application' . DS . 'models' . DS . $class . '.php';
    }
});

/**
 * Get the router path for the MVC structure
 */
$request_uri = explode('/', $_SERVER["REQUEST_URI"]);
$script_name = explode('/', $_SERVER["SCRIPT_NAME"]);

for ($i = 0; $i < count($script_name); $i++)
{
    if($request_uri[$i] == $script_name[$i])
    {
        unset($request_uri[$i]);
    }
}

$command = array_values($request_uri);


$ctr = new SiteController();

switch($command[0])
{

    case 'inschrijven':
        $ctr->inschrijven();
        break;

    case 'uitschrijven':
        $ctr->uitschrijven($command[1]);
        break;

    case '':
        $ctr->index();
        break;

    default:
        // Return a 404 page by default
        http_response_code(404);
        echo "<h3>Page not found - 404</h3>";
        break;
}
