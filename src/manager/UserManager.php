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
            return new User($user->id, $user->username,$user->mail, $user->password);
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
}