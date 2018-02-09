<?php

class Helper
{
    
    /**
     * [redirect description]
     * @param  [type] $url [accepts only the URL]
     * @return [type]      [change header to go to URL]
     */
    public function redirect($url)
    {
        /**
         * If headers not yet sent
         * @return PHP redirect
         */
        if (!headers_sent()) {
            
            header('location: ' . $url);
            exit;
            
        } else {
            /**
             * If headers already sent, do jajascript redirect
             * @return Javascript redirect
             */
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            
            /* If java is disabled => do html redirect */
            /**
             * If Javascript is disabled
             * Do html redirect
             */
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0; url=' . $url . '" />';
            echo '</noscript>';
            exit;
        }
    }
    
    /**
     * [echoActiveClass returns active class if URL matches requested URL]
     * @param  [type]
     * @return [active]
     */
    public function echoActiveClass($requestUri)
    {
        /**
         * [$current_file_name fetch filename from the URL]
         * @var [string url]
         * @return URL
         */
        $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
        
        /**
         * [if check if current file name equals requested URI]
         * @var [echo active]
         */
        if ($current_file_name == $requestUri) {
            echo "active";
        }
    }
    
    
    /**
     * Method to Check if Current Admin User is logged in
     * @var $_SESSION
     * @return true if $_Session Exists
     *else return false
     */
    public function isLoggedIn()
    {
        if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Method to Unset Session Array()
     * This is useful when creating new Admin User
     * Want to clear old array() to create new One
     */
    public function sessionUnset()
    {
        if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
            session_unset();
        }
        return true;
    }
    
    /**
     * Method to set Session Array()
     * This is useful when Loggin in new Admin User
     * Want to clear old array() to create new One
     */
    public function sessionSet($id, $name, $email)
    {
        if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
            $this->sessionUnset();
        }
        session_destroy();
        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['name']    = $name;
        $_SESSION['email']   = $email;
        
        return true;
    }
    
    /**
     * [selectDropDown a quick array to help control al select elements in the
     * front-view. Adding more data into this array, increases all select boxes
     * automatically]
     * @return [type] [description]
     */
    public function selectDropDown()
    {
        $options = array(
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5
        );
        
        return $options;
    }
}