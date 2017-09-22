<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 12.11.11
 * Time: 22:08
 * To change this template use File | Settings | File Templates.
 */
require_once "include/session.php";
require_once "include/warrningDiv.inc.php";
include_once('classes/Microblog/Db/WriteToDB.php');
include_once('classes/Microblog/Db/ReadFromDB.php');

if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='index.php'>Click here</a> for login! ");
}
//validate microblog passwords
if (isset($_POST['oldPassword'])) {
    $oldPassword = $_POST['oldPassword'];
}
if (isset($_POST['newPassword1'])) {
    $newPassword1 = $_POST['newPassword1'];
}
if (isset($_POST['newPassword2'])) {
    $newPassword2 = $_POST['newPassword2'];
}

//nastavi back link na vnos bloga
$backLink = " Pojdi <a href=\"javascript:history.go(-1)\">nazaj!</a>";

//da opozorila prikazejo sumnike!
echo "<meta charset=\"utf-8\" />";

//server side validacija vnosa!
if (isset($oldPassword) && isset($newPassword1) && isset($newPassword2)) {

    //server side validacija - če ni prazen in dolžina!
    if(!empty($oldPassword)) {
        if(strlen($oldPassword)>3 && strlen($oldPassword)<16) {
            //$oldPassword = mysql_real_escape_string($oldPassword);

            //preveri v bazi ali je to geslo prisotno
            $passCheckObj = new ReadFromDB();
            $passwordFromDB = $passCheckObj->getUserPassword(intval($_SESSION['userid']));

            if ($oldPassword !== $passwordFromDB) {
                die($warrningDivStart . "Staro geslo je neznano!" . $backLink . $warrningDivEnd);
            }
            unset($passCheckObj); //unload object

        } else {
            die($warrningDivStart . "Geslo je neustrezne dolžine! (dovoljeno min 4, max 15 znakov)" . $backLink . $warrningDivEnd);
        }
    } else {
        die($warrningDivStart . "Staro geslo je prazno!" . $backLink . $warrningDivEnd);
    }

    if(!empty($newPassword1)) {
        if (strlen($newPassword1)<4 && strlen($newPassword1)>15) {
         die($warrningDivStart . "Geslo je neustrezne dolžine! (dovoljeno min 4, max 15 znakov)" . $backLink . $warrningDivEnd);
        }
    } else {
        die($warrningDivStart . "Novo geslo je prazno!" . $backLink . $warrningDivEnd);
    }

    if(!empty($newPassword2)) {
        if (strlen($newPassword1)<4 && strlen($newPassword1)>15) {
         die($warrningDivStart . "Geslo je neustrezne dolžine! (dovoljeno min 4, max 15 znakov)" . $backLink . $warrningDivEnd);
        }
    } else {
        die($warrningDivStart . "Novo geslo je prazno!" . $backLink . $warrningDivEnd);
    }

    //novi gesli sta enaki, vpisi jih v bazo
    if(($newPassword1 === $newPassword2) && ($newPassword1 !== $oldPassword)) {
        $writePass = new WriteToDB();
        $writeOk = $writePass->writeNewPassword($newPassword1, $_SESSION['userid']);
        if ($writeOk == true) {
            echo $warrningDivStart;
            echo "Geslo je spremenjeno!<br />";
            echo "Lahko nadaljuješ s delom na <a href=\"member.php\">blog-u</a>";
            echo $warrningDivEnd;
        } else {
            echo $warrningDivStart;
            echo "Sprememba gesla ni uspela!";
            echo $warrningDivEnd;
        }
        unset($writePass);
    } else {
        die($warrningDivStart .  "Novi gesli se ne ujemata!" . $backLink . $warrningDivEnd);
    }

} else {
    die($warrningDivStart .  "Gesla niso pravilno vpisana!" . $backLink . $warrningDivEnd);
}

?>
