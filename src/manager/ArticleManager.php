<?php

namespace Amaur\TwigExo\manager;

use Amaur\TwigExo\Classes\Article;
use DateTime;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

class ArticleManager {

    public static function searchId($id):?Article {
        $article = R::load('elliaarticle', $id);

        if(!is_null($article)) {
            return new Article($article->id, $article->title,$article->content, UserManager::searchId($article->author_id), new DateTime($article->datetime));
        }
        return null;
    }

    public static function addArticle(Article $article): bool {
        $title = $article->getTitle();
        $content = $article->getContent();
        $author = $article->getAuthor()->getId();
        $datetime = $article->getDateTime();

        $user = R::load("elliauser", $author);

        if(!in_array('elliaarticle', R::inspect())){
            $table = R::dispense('elliaarticle');
            $table->title = $title;
            $table->content = $content;
            $table->author = $user;
            $table->datetime = $datetime;

            R::store($table);
            return true;
        }
        else {
            $article = R::findOrCreate('elliaarticle', ['title' => $title]);

            if(is_null($article->content)) {
                $article->title = $title;
                $article->content = $content;
                $article->author = $user;
                $article->datetime = $datetime;
                try {
                    R::store($article);
                }
                catch (SQL $e) {}

                return true;
            }
            else {
                return false;
            }
        }
    }

    /**
     * Return array of all article
     * @return array
     */
    public static function getAll():array {
        $allArticles = [];

        $articles = R::findAll("elliaarticle");

        if(count($articles) !== 0) {
            foreach ($articles as $article) {

                $allArticles[] = new Article($article->id, $article->title, $article->content, UserManager::searchId($article->author_id), new DateTime($article->datetime));
            }
        }
        return $allArticles;
    }

    /**
     * Update information of article
     * @param Article $article
     */
    public static function update(Article $article) {
        $id = $article->getId();
        $title = $article->getTitle();
        $content = $article->getContent();

        $user = R::load('elliauser', $article->getAuthor()->getId());

        $articleUpdate = R::load("elliaarticle", $id);
        $articleUpdate->title = $title;
        $articleUpdate->content = $content;
        $articleUpdate->author = $user;

        try {
            R::store($articleUpdate);
        }
        catch (SQL $e) {}
    }

    /**
     * Delete a user into article table
     * @param $id
     */
    public static function deleteArticle($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        R::trash("elliaarticle", $id);
    }
}