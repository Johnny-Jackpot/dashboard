<?php


class UserController {
     /**
     * Check user
     * @return boolean
     */
    public static function checkUser() {
        $userId = User::checkLogged();
        $user = User::getUser($userId);
              
        if ($user) { return $user['id']; }
        
        header("Location: /user/login");
    }
    
    /**
     * Render and processing user login
     * @return boolean
     */
    public function actionLogin() {
                
        $email = '';
        $password = '';
        
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            
            $userId = User::checkUserData($email, $password);
            
            if ($userId === false) {
                $errors = 'Неправильні дані';
            } else {
                User::auth($userId);
                header("Location: /");
            }
        }
        
        require_once(ROOT . '/views/user/login.php');
        
        return true;
    }
    
    /**
     * Logout user
     */
    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: /");
    }
    
}