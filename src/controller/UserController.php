<?php

namespace Amaur\TwigExo\Controller;

use Amaur\TwigExo\Classes\User;
use Amaur\TwigExo\Manager\UserManager;

class UserController extends Controller {
    /**
     * Redirects into home page
     */
    public function homePage() {
        $allUser = UserManager::getAll();
        self::render("user.page.html.twig", ["users" => $allUser]);
    }

    /**
     * Redirects into crud page for create user
     * @throws \Twig\Error\Error
     */
    public function create() {
        $title = "Création d'utilisateur";
        self::render("crud.page.html.twig", ['title' => $title, 'type' => 'createUser']);
    }

    /**
     * Create a user into database
     */
    public function createUser() {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $user = new User(null, $username, $password, $mail);

        UserManager::addUser($user);
        header("Location: ./index.php");
    }

    /**
     * Redirects into crud page for update user
     */
    public function update() {
        $title = "Modification d'utilisateur";

        $user = UserManager::searchId(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
        self::render("crud.page.html.twig", ['title' => $title, 'type' => 'updateUser', 'user' => $user]);
    }

    /**
     * Update information of a user
     */
    public function updateUser() {
        $user = UserManager::searchId(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
        $user
            ->setUsername(filter_var($_POST['username'], FILTER_SANITIZE_STRING))
            ->setMail(filter_var($_POST['email'], FILTER_SANITIZE_STRING))
        ;

        UserManager::update($user);
        header("Location: ./index.php");
    }

    public function delete() {
        $title = "Suppression de l'utilisateur?";

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        self::render("crud.page.html.twig", ['title' => $title, 'type' => 'delete', 'id' => $id, 'action' => 'deleteUser', 'controller' => "user"]);
    }

    public function deleteUser() {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        UserManager::deleteUser($id);
        header("Location: ./index.php");
    }
}