<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 14.11.11
 * Time: 10:33
 * To change this template use File | Settings | File Templates.
 */
require_once "include/session.php";
require_once "include/warrningDiv.inc.php";
include_once('classes/Microblog/Db/WriteToDB.php');

$backLink = " Pojdi <a href=\"javascript:history.go(-1)\">nazaj!</a>";

if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='index.php'>Click here</a> for login! ");
} else {
    echo "<meta charset=\"utf-8\" />";
    if(isset($_SESSION['userlevel']) && $_SESSION['userlevel']<1) {
        if (!empty($_GET['entryId'])) {
            $deleteEntry = new WriteToDB();
            $entryId = intval($_GET['entryId']);
            $deleted = $deleteEntry->deleteEntry($entryId);
            if($deleted) {
                echo $warrningDivStart;
                echo "Zbrisan vnos št.: " . $entryId . "<br />";
                echo "Lahko nadaljuješ s delom na <a href=\"member.php\">blog-u</a>";
                echo $warrningDivEnd;
            } else {
                echo $warrningDivStart;
                echo "Vnos št.: " . $entryId . " ni zbrisan!<br />";
                echo "Lahko nadaljuješ s delom na <a href=\"member.php\">blog-u</a>";
                echo $warrningDivEnd;
            }
            unset($deleteEntry);
        } else {
            die($warrningDivStart . "Ni šifre vnosa za brisanje!" . $backLink . $warrningDivEnd);
        }
    } else {
        echo $warrningDivStart . "Nimaš ustreznih pravic!" . $backLink . $warrningDivEnd;
    }
}

?>