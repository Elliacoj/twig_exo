<?php

namespace Amaur\TwigExo\Controller;

use Amaur\TwigExo\Classes\Article;
use Amaur\TwigExo\manager\ArticleManager;
use Amaur\TwigExo\Manager\UserManager;
use DateTime;

class ArticleController extends Controller {
    /**
     *
     */
    public function homePage() {
        $allArticle = ArticleManager::getAll();
        self::render("article.page.html.twig", ['articles' => $allArticle]);
    }

    public function create() {
        $title = "Création d'article";
        $allUser = UserManager::getAll();
        self::render("crud.page.html.twig", ['title' => $title, 'type' => 'createArticle', "users" => $allUser]);
    }

    public function createArticle() {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $datetime = new DateTime();
        $user = UserManager::searchId(filter_var($_POST['author'], FILTER_SANITIZE_NUMBER_INT));

        $article = new Article(null, $title, $content, $user, $datetime);
        ArticleManager::addArticle($article);
        header("Location: ./index.php?controller=article");
    }

    /**
     * Redirects into crud page for update article
     */
    public function update() {
        $title = "Modification d'article";

        $allUser = UserManager::getAll();
        $article = ArticleManager::searchId(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
        self::render("crud.page.html.twig", ['title' => $title, 'type' => 'updateArticle', 'article' => $article, "users" => $allUser]);
    }

    /**
     * Update information of a user
     */
    public function updateArticle() {
        $article = ArticleManager::searchId(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
        $article
            ->setTitle(filter_var($_POST['title'], FILTER_SANITIZE_STRING))
            ->setContent(filter_var($_POST['content'], FILTER_SANITIZE_STRING))
            ->setAuthor(UserManager::searchId(filter_var($_POST['author'], FILTER_SANITIZE_NUMBER_INT)))
        ;
        print_r($article);

        ArticleManager::update($article);
        header("Location: ./index.php?controller=article");
    }

    /**
     * Redirects into crud page for delete article
     */
    public function delete() {
        $title = "Suppression de l'article?";

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        self::render("crud.page.html.twig", ['title' => $title, 'type' => 'delete', 'id' => $id, 'action' => 'deleteArticle', "controller" => 'article']);
    }

    public function deleteArticle() {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        ArticleManager::deleteArticle($id);
        header("Location: ./index.php?controller=article");
    }
}