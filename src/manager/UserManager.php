<?php

namespace Amaur\TwigExo\Manager;


use Amaur\TwigExo\Classes\User;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

class UserManager extends Manager {

    /**
     * Return a user or null
     * @param $id
     * @return User|null
     */
    public static function searchId($id):?User {
        $user = R::load('elliauser', $id);

        if(!is_null($user)) {
            return new User($user->id, $user->username, $user->password, $user->mail);
        }
        return null;
    }

    /**
     * Add a user if is not exist
     */
    public static function addUser(User $user): bool {
        $username = $user->getUsername();
        $mail = $user->getMail();
        $password = $user->getPassword();

        if(!in_array('elliauser', R::inspect())){
            $table = R::dispense('elliauser');
            $table->username = $username;
            $table->mail = $mail;
            $table->password = password_hash($password, PASSWORD_BCRYPT);

            R::store($table);
            return true;
        }
        else {
            $user = R::findOrCreate('elliauser', ['mail' => $mail]);

            if(is_null($user->password)) {
                $user->username = $username;
                $user->mail = $mail;
                $user->password = password_hash($password, PASSWORD_BCRYPT);
                try {
                    R::store($user);
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
     * Return array of all user
     * @return array
     */
    public static function getAll():array {
        $allUser = [];

        $users = R::findAll("elliauser");

        if(count($users) !== 0) {
            foreach ($users as $user) {
                $allUser[] = new User($user->id, $user->username, $user->password, $user->mail);
            }
        }
        return $allUser;
    }

    /**
     * Update information of user
     * @param User $user
     */
    public static function update(User $user) {
        $id = $user->getId();
        $username = $user->getUsername();
        $mail = $user->getMail();

        $userUpdate = R::load("elliauser", $id);
        $userUpdate->username = $username;
        $userUpdate->mail = $mail;

        try {
            R::store($userUpdate);
        }
        catch (SQL $e) {}
    }

    /**
     * Delete a user into user table
     * @param $id
     */
    public static function deleteUser($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        R::trash("elliauser", $id);
    }
}