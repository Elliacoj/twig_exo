<?php

namespace Amaur\TwigExo\Controller;

class HomePageController extends Controller {
    /**
     *
     */
    public function homePage() {
        self::render("user.page.html.twig");
    }
}