<?php
require_once('dbManager.php');
require_once('session.php');
class scorer {
    public static function signIn($username, $password) {
        $account = self::selectAccount($username);
        if ($account != FALSE) {
            if ($account['scrrPassword'] == $password) {
                session::register($account['scrrId'], $account['scrrName']);
                self::turnToEntry();
            } else {
                self::turnToLogin();
            }
        } else {
            self::turnToLogin();
        }
    }

    public static function selectAccount($username) {
        $connection = dbManager::createConnection();

        $result = mysqli_query($connection, 'SELECT * FROM scorer WHERE scrrName="'.$username.'"');
        if ($result == False) {
            return FALSE;
        }

        while ($row = mysqli_fetch_array($result)) {
            return $row;
        }

        return FALSE;
        dbManager::closeConnection();      
    }

    private static function turnToLogin() {
        header("location:../home-scorer-login.php");
    }

    private static function turnToEntry() {
        header("location:../home-scorer.php");    
    }
}
?>