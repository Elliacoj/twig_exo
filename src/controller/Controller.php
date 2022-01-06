<?php

namespace Amaur\TwigExo\Controller;

use Twig\Environment;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class Controller extends Environment {
    /**
     * Construct
     */
    public function __construct() {
        $loader = new FilesystemLoader(dirname(__DIR__) . '/../templates');
        parent::__construct($loader, [
            /*'debug' => true,
            'strict_variables' => true,
            'cache' => '../../var/cache',
            'auto_reload' => true*/
        ]);

        $this->addExtension(new DebugExtension());
    }

    /**
     * @param $name
     * @param array $context
     * @return string
     * @throws Error
     */
    public function render($name, array $context = []):string {
        try {
            $tpl = parent::render($name, $context);
        }
        catch (LoaderError | RuntimeError | SyntaxError $e) {
            throw new Error("Error loading template '$name'");
        }
        echo $tpl;
        return  $tpl;
    }
}