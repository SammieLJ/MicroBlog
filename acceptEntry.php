<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 11.11.11
 * Time: 18:56
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

echo "<meta charset=\"utf-8\" />";
$backLink = " Pojdi <a href=\"javascript:history.go(-1)\">nazaj!</a>";

if(isset($_SESSION['userlevel']) && $_SESSION['userlevel']<2) {

    //validate microblog entry
    if (isset($_POST['headline'])) {
        $headline = $_POST['headline'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['website'])) {
        $website = $_POST['website'];
    }
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];
    }
    if (isset($_POST['entryID'])) {
        $entryId = $_POST['entryID'];
    }
        
/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/

//nastavi back link na vnos bloga
//$backLinkToAddEntry = "<a href=\"member.php?p=enterblog\">Klik nazaj</a> na vnos bloga.";
$backLinkToAddEntry = " Pojdi <a href=\"javascript:history.go(-1)\">nazaj</a>";

        //server side validacija vnosa!
        if (isset($headline)&&isset($email)&&isset($website)&&isset($comment)) {

            //da opozorila prikazejo sumnike!
            echo "<meta charset=\"utf-8\" />";

            //server side validacija - če ni prazen in dolžina!
            if(!empty($headline)) {
                if(strlen($headline)>60) {
                    die($warrningDivStart . "Naslov je predolg! (dovoljeno max 60 znakov)" . $backLinkToAddEntry . $warrningDivEnd);
                }
            } else {
                die($warrningDivStart . "Ni vnešenega naslova vsebine!" . $backLinkToAddEntry . $warrningDivEnd);
            }

            if(!empty($email)) {
                if (!filter_var ($email, FILTER_VALIDATE_EMAIL)) {
                 die($warrningDivStart . "Napačano vpisan email!" . $backLinkToAddEntry . $warrningDivEnd);
                }
            } else {
                die($warrningDivStart . "Ni vnešenega email-a!" . $backLinkToAddEntry . $warrningDivEnd);
            }

            if(!empty($website)) {
                if (!preg_match ('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $website)) {
                    die($warrningDivStart . "Napačano vpisan spletni naslov!" . $backLinkToAddEntry . $warrningDivEnd);
                }
            } else {
                die($warrningDivStart . "Ni vnešenega spletnega naslova!" . $backLinkToAddEntry . $warrningDivEnd);
            }

            if(!empty($comment)) {
                if(strlen($comment)>420) {
                    die($warrningDivStart . "Vnešena vsebina teksta za blog je predolga! (dovoljeno max 420 znakov)" . $backLinkToAddEntry . $warrningDivEnd);
                }
            } else {
                die($warrningDivStart . "Ni vnešene vsebine bloga!" . $backLinkToAddEntry . $warrningDivEnd);
            }

            if (!empty($entryId)) {
                $updateEntry = new WriteToDB();

                $updateEntry->updateEntry($entryId, $headline, $comment, $email, $website);
                echo $warrningDivStart;
                echo "Popravljen vnos s zaporedno št.: " . $entryId . "<br />";
                echo "Lahko nadaljuješ s delom na <a href=\"member.php\">blog-u</a>";
                echo $warrningDivEnd;

                unset($updateEntry);

            } else {
                //preziveli validacijo sedaj pa vnos v bazo
                $writeEntry = new WriteToDB();

                $insertId = $writeEntry->addEntry($headline, $comment, $email, $website, $_SESSION['userid']);

                if ($insertId > 0) {
                    echo $warrningDivStart;
                    echo "Vnešeno pod zaporedno št.: " . $insertId . "<br />";
                    echo "Lahko nadaljuješ s delom na <a href=\"member.php\">blog-u</a>";
                    echo $warrningDivEnd;
                } else {
                    echo $warrningDivStart;
                    echo "Vnos novice ni uspel!";
                    echo $warrningDivEnd;
                }
                unset($writeEntry);
          }
        } else {
            echo $warrningDivStart . "Vsa polja vnosa so prazna!" . $backLink . $warrningDivEnd;
        }

    } else {
        echo $warrningDivStart . "Nimaš ustreznih pravic!" . $backLink . $warrningDivEnd;
    }

?>