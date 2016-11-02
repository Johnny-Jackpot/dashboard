<?php

class User {
    /**
     * Check whether user is logged in
     * @return string <p>user id</p>
     */
    public static function checkLogged() {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        
        header("Location: /user/login");
    }
    
    /**
     * Return user data
     * @param string $id
     * @return array or false
     */
    public static function getUser($id) {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            return $result->fetch();
        }
    }
     /**
      * Check user data
      * @param string $email
      * @param string $password
      * @return boolean
      */
    public static function checkUserData($email, $password) {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        $user = $result->fetch();
        if ($user && password_verify($password, $user['hash'])) {
            return $user['id'];
        }
        
        return false;
    }
    
    public static function auth($userId){
        $_SESSION['user'] = $userId;
    }
}

