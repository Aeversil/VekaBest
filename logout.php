<?php
/**
 * Created by PhpStorm.
 * User: duncc
 * Date: 11/6/2017
 * Time: 9:46 AM
 */

session_start();
session_destroy();
header("location: user_login.php");
exit();
