<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 10.11.11
 * Time: 13:12
 * To change this template use File | Settings | File Templates.
 */
require_once("include/session.php");

if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='index.php'>Click here</a> for login! ");
}

//unset searchbox fields
unset($_SESSION['searchbox']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="utf-8" />
    <title>Microblog</title>
    <link href="stylesheets/member.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
<div id="header"><h1>Microblog - demo</h1>
</div>

<div id="menu">
    <a href="member.php">Blogi</a>
    <a href="member.php?p=find">Išči</a>
<?php
    if(isset($_SESSION['userlevel'])&&$_SESSION['userlevel']<2) {
    ?>
    <a href="member.php?p=enterblog">Vnesi blog</a>
<?php
    }
    ?>
    <a href="member.php?p=changepass">Spremeni geslo</a>
<?php
    if(isset($_SESSION['userlevel'])&&$_SESSION['userlevel']==0) {
    ?>
    <a href="member.php?p=manageusers">Uredi uporabnike</a>
<?php
    }
    ?>
    <a href="member.php?p=getsources">Izvorna koda</a>
    <a href='logout.php'>Logout</a>
    <?php
        echo "<span id=\"rightBox\">Logiran: <b>" . $_SESSION['username'] . "</b> [" . $_SESSION['roledesc'] . "]</span>";
    ?>

</div>
<div id="content"><div style="height: 5px"></div>
  <?php
     $blogFound = false;
     $pages_dir = 'pages';
     if (!empty($_GET['p'])) {
        $pages = scandir($pages_dir, 0);
        unset($pages[0], $pages[1]);

        //print_r($pages);
        $p = $_GET['p'];

        if (in_array($p.'.inc.php', $pages)) {
            include($pages_dir.'/'.$p.'.inc.php');
        } else {
            echo "<div id='entry'><h3>Zahtevana stran ne obstaja!</h3></div>";
        }
     } else {
         /*if (!empty($_GET['entryId'])) {
            $_SESSION['entryId'] = $_GET['entryId'];
            unset($_GET['entryId']);
            include($pages_dir.'/enterblog.inc.php');
         } else {
            include($pages_dir.'/blog.inc.php');
         }*/
         include($pages_dir.'/blog.inc.php');
     }
  ?>
</div>
</body>

</html>