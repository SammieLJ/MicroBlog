<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 14.11.11
 * Time: 1:13
 * To change this template use File | Settings | File Templates.
 */
 require_once "include/session.php";
 require_once "include/warrningDiv.inc.php";
 include_once('classes/Microblog/Db/WriteToDB.php');

 if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='index.php'>Click here</a> for login! ");
 }
 $backLink = " Pojdi <a href=\"javascript:history.go(-1)\">nazaj!</a>";

 //da opozorila prikazejo sumnike!
 echo "<meta charset=\"utf-8\" />";

if(isset($_SESSION['userlevel']) && $_SESSION['userlevel']<1) {

    /*echo '<pre>';
    print_r($_POST);
    echo '</pre>';*/

    //validate microblog passwords
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['userpassword'])) {
        $userpassword = $_POST['userpassword'];
    }
    if (isset($_POST['userlevel'])) {
        $userlevel = intval($_POST['userlevel']);
    }
    if (isset($_POST['userIdToDelete'])) {
        $userIdToDelete = intval($_POST['userIdToDelete']);
        $deleteUserAction = true;
    } else {
        $deleteUserAction = false;
    }
    
    if (isset($username) && isset($userpassword) && isset($userlevel) && $deleteUserAction === false) {

        if($_SESSION['username'] === $username) {
            die($warrningDivStart . "Ta uporabnik z istim uporabniškim imenom že obstaja!" . $backLink . $warrningDivEnd);
        }

        if (empty($username)) {
            die($warrningDivStart . "Uporabniško ime je prazno!" . $backLink . $warrningDivEnd);
        } else {
            if(strlen($username)<4 || strlen($username)>15) {
                die($warrningDivStart . "Uporabniško ime je neustrezno dolgo (min 4, max 15 znakov)!" . $backLink . $warrningDivEnd);
            }
        }

        if (empty($userpassword)) {
            die($warrningDivStart . "Geslo je prazno!" . $backLink . $warrningDivEnd);
        } else {
            if(strlen($userpassword)<4 || strlen($userpassword)>15) {
                die($warrningDivStart . "Geslo je neustrezno dolgo (min 4, max 15 znakov)!" . $backLink . $warrningDivEnd);
            }
        }

        if (is_numeric($userlevel)) {
            if ($userlevel > 100) {
                die($warrningDivStart . "Stopnja uporabnika nesme presegati števila 100!" . $backLink . $warrningDivEnd);
            }
        } else {
                die($warrningDivStart . "Stopnja uporabnika mora biti številka!" . $backLink . $warrningDivEnd);
        }
		
        $addNewUserObj = new WriteToDB();
        $newUserId = $addNewUserObj->addNewUser($username, $userpassword, $userlevel);
        unset($addNewUserObj);
        
        if ($newUserId > -1) {
            echo $warrningDivStart;
            echo "Nov uporabnik št." . $newUserId ." je dodan!<br />";
            echo "Lahko nadaljuješ s delom na <a href=\"member.php?p=manageusers\">urejanju uporabnikov!</a>";
            echo $warrningDivEnd;
        } else {
            echo $warrningDivStart;
            echo "Nov uporabnik ni dodan!<br />";
            echo "Lahko nadaljuješ s delom na <a href=\"member.php?p=manageusers\">urejanju uporabnikov!</a>";
            echo $warrningDivEnd;
        }
    }

    if (!isset($_POST['username']) && $deleteUserAction === true) {
        $deleteUserObj = new WriteToDB();
        $deleteOK = $deleteUserObj->deleteUser($userIdToDelete);
        unset($deleteUserObj);

        if ($deleteOK) {
            echo $warrningDivStart;
            echo "Izbran uporabnik je zbrisan!<br />";
            echo "Lahko nadaljuješ s delom na <a href=\"member.php?p=manageusers\">urejanju uporabnikov!</a>";
            echo $warrningDivEnd;
        } else {
            echo $warrningDivStart;
            echo "Izbran uporabnik ni zbrisan!<br />";
            echo "Lahko nadaljuješ s delom na <a href=\"member.php?p=manageusers\">urejanju uporabnikov!</a>";
            echo $warrningDivEnd;
        }
    }/*else {
        die($warrningDivStart . "Stopnja uporabnika mora biti številka!" . $backLink . $warrningDivEnd);
    }*/
} else {
    echo $warrningDivStart . "Nimaš ustreznih pravic!" . $backLink . $warrningDivEnd;
}
?>