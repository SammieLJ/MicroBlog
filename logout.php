<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 10.11.11
 * Time: 13:20
 * To change this template use File | Settings | File Templates.
 */
 include "include/session.php";
 session_destroy();

 //for older browsers, or if something horrobly, horrobly goes wrong, do it manually - samirs
 echo("You're been logged out. <a href='index.php'>Click here</a> for login!");

 //forward to index.php
 print "<script>";
 print " self.location='index.php';"; // Comment this line if you don't want to redirect
 print "</script>";
?>