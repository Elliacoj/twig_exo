<?php

namespace Amaur\TwigExo\Controller;

class ArticleController extends Controller {
    /**
     *
     */
    public function homePage() {
        self::render("article.page.html.twig");
    }
}