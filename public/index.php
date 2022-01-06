<?php

use Amaur\TwigExo\Controller\HomePageController;

require "../vendor/autoload.php";
require "../config.php";

if(isset($_GET['controller'])) {
    $controller = "Amaur\\TwigExo\\Controller\\" . ucfirst(filter_var($_GET['controller'], FILTER_SANITIZE_STRING)) . "Controller";
    if(class_exists($controller)) {
        $controller = new $controller();


        if(isset($_GET['action'])) {
            $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);

            try {
                $reflection = new ReflectionClass($controller);

                if($reflection->hasMethod($action)) {
                    $controller->$action();
                }
                else {
                    $controller->homePage();
                }
            }
            catch (ReflectionException $e) {}
        }
        else {

            $controller->homePage();
        }
    }
    else {
        (new HomePageController())->homePage();
    }
}
else {
    (new HomePageController())->homePage();
}