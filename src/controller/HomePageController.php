<?php

namespace Amaur\TwigExo\Controller;

use Amaur\TwigExo\Manager\UserManager;

class HomePageController extends Controller {
    /**
     *
     */
    public function homePage() {
        $allUser = UserManager::getAll();
        self::render("user.page.html.twig", ["users" => $allUser]);
    }
}