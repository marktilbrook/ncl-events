<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 21-Oct-19
 * Time: 9:52 AM
 */

function getConnection()
{
    try {
        $connection = new PDO("mysql:host=localhost;dbname=unn_w17006267",
            "unn_w17006267", "marrwk111");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        /* We should log the error to a file so the developer can look at any logs. However, for now we won't */
        throw new Exception("Connection error ". $e->getMessage(), 0, $e);
    }
}//function getConnection()

function set_session($sessionKey, $value)
{
    //save path
    ini_set("session.save_path", "/home/unn_w17006267/sessionData");
    session_start();
    // Set key element = value
    $_SESSION[$sessionKey] = $value;

    return $value;
}//function set_session





function get_session($sessionKey)
{

    $sessionValue = "";
    if(isset($_SESSION['$sessionKey']))
    {
        $sessionValue = $_SESSION['$sessionKey'];
    }
    return $sessionValue;

}//function get_session





function check_login()
{
    return get_session('logged-in');
}

function log_out()
{
    if (check_login())
    {
        //clear the session array
        $_SESSION = array();

        //destroy this session
        session_destroy();

        echo "<p>Logging Out!</p>\n";

//        header("Location: logInForm.php");
    }

}