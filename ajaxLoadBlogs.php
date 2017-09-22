<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 18.11.11
 * Time: 16:18
 * To change this template use File | Settings | File Templates.
 */
if(!isset($_SESSION)) {
     session_start();
}
if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='../index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='../index.php'>Click here</a> for login! ");
}
if(isset($_POST['pageidx']) || !empty($_POST['pageidx'])) {
   $pageidx = mysql_real_escape_string($_POST['pageidx']);
    echo "Dobu AJAX Req.! --> ";
} else {
   $pageidx = 1;
}
//$pageidx = 1;
/*if(!empty($_REQUEST['previous'])) {
    $pageidx = $_POST['pageidx'];
    if ($pageidx > 0) {
        $pageidx = $pageidx - 1;
    }
}
if(!empty($_REQUEST['next'])) {
    $pageidx = $_POST['pageidx'];
    if ($pageidx <= $pageidx) {
        $pageidx = $pageidx + 1;
    }
}*/
//echo "PAGEINDEX: " . $pageidx . " POST:" .  $_POST['pageidx'];
//include_once("classes/Microblog/Model/Entry.php");

$entries = array();

 //read data from db and store into session for ajax blog loader
include_once("classes/Microblog/Db/ReadFromDB.php");
$readFromDB = new ReadFromDB();
$entries = $readFromDB->getEntries();
unset($readFromDB);  //unload object

 /* check if we have some entries */
if (empty($entries)) {
?>
    <div id="entry"><h3>Ni nobene objave!</h3></div>
<?php
} else {
echo " START ";
/* print all microblog entries */
$allEntries = count($entries);
$lastPageIdx = round(($allEntries /3), 0, PHP_ROUND_HALF_UP);

$previousIdx = $pageidx-1;
echo "PAGE IDX: $pageidx PROGRAM PAGE IDX: $previousIdx";
$startEntry = ($previousIdx * 3) + 1;
/*if ($startEntry === 0) {
    $startEntry = 1;
}*/
$stopEntry = ($pageidx) * 3;
echo "AllEntries: " . $allEntries . " lastPageIdx:" . $lastPageIdx . " startEntry:" . $startEntry . " stopEntry:" . $stopEntry;

//foreach ($entries as $value) {
for ($i = $startEntry; $i <= $stopEntry; $i++) {
    if (!empty($entries[$i])) {
    $value = $entries[$i];
?>
    <div id="entry">
    <div>
        <?php
        if ($_SESSION['userlevel'] === 1 && $_SESSION['userid'] === $value->getUserId()) {
        ?>
            <a href="member.php?p=enterblog&entryId=<?=$value->getEntryId()?>">Popravi</a>
        <?php
        }

        if ($_SESSION['userlevel'] === 0) {
        ?>
            <a href="member.php?p=enterblog&entryId=<?=$value->getEntryId()?>">Popravi</a>&nbsp;<a href="deleteEntry.php?entryId=<?=$value->getEntryId()?>">Briši</a>
        <?php
        }
        ?>
    </div>
    <h3>#<?=$value->getEntryId()?>&nbsp;<?=$value->getHeadline()?></h3>
    <div><?=$value->getBody()?></div><br />
    <div>Avtor: <?=$value->getAuthor()?></div>
    <div>Kontakt: <i><a href="mailto:<?=$value->getEmail()?>"><?=$value->getEmail()?></a></i></div>
    <?php
    $temp_weburl = $value->getWeburl();
    if (!empty($temp_weburl)) {
    ?>
    <div>Vir: <a href="<?=$temp_weburl?>"><?=$temp_weburl?></a></div>
<?php
    }
  } // check for empty
?>
   </div>
<?php
    } //end of foreach
}//end of if-else

//if need previous and next buttons
if ($allEntries > 3)
{
?>
<div id="navigation" style="height: 10px;">
<form action="member.php" id="navform">Stran:&nbsp;<?=$pageidx?>&nbsp;/&nbsp;<?=$lastPageIdx?>
    <input type="hidden" id="pageidx" name="pageidx" value="<?=$pageidx?>"/>
    <input type="hidden" id="lastPageIdx" name="lastPageIdx" value="<?=$lastPageIdx?>"/>
    <input type="button" id="previous" name="previous" value="Nazaj" onclick="setPrevious();" />
    <input type="button" id="next" name="next" value="Naprej" onclick="setNext();" />
</form>
</div>
<?php
} //end of we have enought entries to place buttons ?>