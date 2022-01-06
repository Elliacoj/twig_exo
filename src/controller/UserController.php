<?php

namespace Amaur\TwigExo\Controller;

class UserController extends Controller {
    /**
     *
     */
    public function homePage() {
        self::render("user.page.html.twig");
    }

    public function create() {
        $title = "Création d'utilisateur";
        self::render("crud.page.html.twig", ['title' => $title, 'type' => 'createUser']);
    }
}