<?php
/**
 * Created by PhpStorm.
 * User: Samir Subašić
 * Date: 11.11.2017
 * Time: 13:50
 */

require_once("include/session.php");

if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='index.php'>Click here</a> for login! ");
}
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
        $pages_dir = 'pages';
        include($pages_dir.'/blog.inc.php');
    ?>
    <input type="hidden" id="page" name="page" value="<?php echo $_POST['page']; ?>" />
    <input type="hidden" id="headline" name="headline" value="<?php echo $_POST['headline']; ?>" />
    <input type="hidden" id="body" name="body" value="<?php echo $_POST['body']; ?>" />
    <input type="hidden" id="email" name="email" value="<?php echo $_POST['email']; ?>" />
    <input type="hidden" id="weburl" name="weburl" value="<?php echo $_POST['weburl']; ?>" />
</div>
</body>


