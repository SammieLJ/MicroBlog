<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 10.11.11
 * Time: 0:22
 * To change this template use File | Settings | File Templates.
 */
require_once("include/session.php");
require_once("include/warrningDiv.inc.php");
include_once('classes/Microblog/Db/ReadFromDB.php');

//za warrning sporocila
echo "<meta charset=\"utf-8\" />";

//nastavi back link na vnos bloga
$backLink = " Pojdi <a href=\"javascript:history.go(-1)\">nazaj!</a>";

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}

function setNewSession($user_id, $user_name, $userLevel, $roleDesc) {
    $_SESSION['id']=session_id();
    $_SESSION['userid']=$user_id;
    $_SESSION['username']=$user_name;
    $_SESSION['userlevel']=$userLevel;
    $_SESSION['roledesc']=$roleDesc;
    //$_SESSION['userId']=$userId;
}

if (isset($username)&&!empty($username)&&isset($password)&&!empty($password)) {

    if (strlen($username)<4 && strlen($username)>15) {
         die($warrningDivStart . "Uporabniško ime je neustrezne dolžine! (dovoljeno min 4, max 15 znakov)" . $backLink . $warrningDivEnd);
    }

    if (strlen($password)<4 && strlen($password)>15) {
         die($warrningDivStart . "Geslo je neustrezne dolžine! (dovoljeno min 4, max 15 znakov)" . $backLink . $warrningDivEnd);
    }

    /* check username and password from Db */
    $usrLoginObj = new ReadFromDB();
    $numrows = $usrLoginObj->getLoginUser($username, $password, $dbUserId, $dbusername, $dbpassword, $dbUserLevel, $dbRoleDesc);
    unset($usrLoginObj);

    if ($numrows != 0) {

        //check to see if they match!
        if($username==$dbusername && $password==$dbpassword)
        {
            setNewSession($dbUserId, $username, $dbUserLevel, $dbRoleDesc);
            echo "Logiran si! Klikni na povezavo <a href='member.php'>naprej</a>!";

            //forward to member.php
            print "<script>";
            print " self.location='member.php';"; // Comment this line if you don't want to redirect - samirs
            print "</script>";
            //echo '<br />';
            //var_dump($_SESSION);
            session_write_close(); 
        } else {
           echo $warrningDivStart . "Nisi logiran! Vnešeni so bili nedovoljeni znaki!" . $backLink . $warrningDivEnd;
        }

    } else {
        die($warrningDivStart . "Ta uporabnik ne obstaja ali napačno vpisano geslo!" . $backLink . $warrningDivEnd);
    }

} else {
    die($warrningDivStart . "Prosim vpišite uporabniško ime in geslo!" . $backLink . $warrningDivEnd);
}
?>