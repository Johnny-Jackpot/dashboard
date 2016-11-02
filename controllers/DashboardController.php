<?php
/**
 * Describe Dashboard rendering and behavior
 */
class DashboardController {
    /**
     * Render Dashboard
     * @return boolean
     */
    public function actionIndex() {
        $userId = UserController::checkUser();
        $dashboard = Dashboard::getDashboard($userId);
        $pageName = $dashboard['pageName'];
        $pageDescription = $dashboard['pageDescription'];
        require_once ROOT . '/views/dashboard/index.php';
        return true;
    }
    /**
     * Editing page`s name
     * @return boolean
     */
    public function actionEditPageName() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST' &&
                !isset($_POST['pageName'])) {
            http_response_code(501);
            return true;
        }
        $userId = UserController::checkUser();
        $pageName = filter_var($_POST['pageName'], FILTER_SANITIZE_STRING);
        $result = Dashboard::editPageName($pageName, $userId);
        if (!$result) {
            http_response_code(500);
        }
        return true;
    }
    /**
     * Editing page`s description
     * @return boolean
     */
    public function actionEditPageDescription() {
        UserController::checkUser();
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST' ||
                !isset($_POST['pageDescription'])) {
            http_response_code(501);
            return true;
        }
        $userId = UserController::checkUser();
        $pageDescription = filter_var($_POST['pageDescription'], FILTER_SANITIZE_STRING);
        $result = Dashboard::editPageDescription($pageDescription, $userId);
        if (!$result) {
            http_response_code(500);
        }
        return true;
    }
    
    /**
     * Send feedback from dashboard
     * @return boolean
     */
    public function actionSendEmail() {
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST'
                || !isset($_POST['userName'])
                || empty($_POST['userName'])
                || !isset($_POST['userEmail'])
                || empty($_POST['userEmail'])
                || !isset($_POST['userFeedback'])
                || empty($_POST['userFeedback'])) {
            
                    http_response_code(500);
                    return true;
                    
        }
        
        UserController::checkUser();
        
        $userName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);
        $userMessage = filter_var($_POST['userFeedback'], FILTER_SANITIZE_STRING);
        
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            http_response_code(500);
            return true;
        }    
        
        /*
         * SendPulse REST API
         *
         * Documentation
         * https://login.sendpulse.com/manual/rest-api/
         * https://sendpulse.com/api
         */
        require_once(ROOT . '/components/lib/email/api/sendpulseInterface.php');
        require_once(ROOT . '/components/lib/email/api/sendpulse.php');
        define('API_USER_ID', '-api-user-id-');
        define('API_SECRET', '-api-user-secret-');
        $SPApiProxy = new SendpulseApi(API_USER_ID, API_SECRET, 'file');
        $email = array(
            'html' => '',
            'text' => $userMessage,
            'subject' => "New feedback from {$userName}  ($userEmail)",
            'from' => array(
                'name' => 'Dashboard',
                'email' => '-sendpulse-email-registered-on-'
            ),
            'to' => include(ROOT . '/config/emailAddressesTo.php')
        );
        
        
        
        $result = $SPApiProxy->smtpSendMail($email);
        
        if (isset($result->is_error) && $result->is_error) {
            http_response_code($result->http_code);
        }
        return true;
    }
    /**
     * Get coordinates of draggable image
     */
    public function actionGetCoord() {
        $userId = UserController::checkUser();
        
        $result = Dashboard::getCoord($userId);
        
        if (!$result) {
            http_response_code(500);
        } else {
            echo $result;
        }
        
        return true;
    }
    
    /**
     * Set coordinates of draggable image
     */
    public function actionSetCoord() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST'
                || !isset($_POST['draggablePosition'])
                || empty($_POST['draggablePosition'])) {
                    http_response_code(404);
                }
                
        $userId = UserController::checkUser();
        
        $coordinates = $_POST['draggablePosition'];
        
        $result = Dashboard::setCoord($userId, $coordinates);
        
        if (!$result) {
            http_response_code(500);
        }
        
        return true;
    }
}