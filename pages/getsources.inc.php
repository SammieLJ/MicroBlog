<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 16.11.11
 * Time: 10:35
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
 /*echo '<pre>';
 print_r($_POST);
 echo '</pre>';*/

include_once('classes/Microblog/Db/WriteToDB.php');
$file1 = 'MicroBlog-demo_no_ns.zip';
$file2 = 'MicroBlog-demo_with_ns.zip';
$successful = false;

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $logEntry = new WriteToDB();
    $successful = $logEntry->insertEmail($_POST['email']);

    if ($successful) {
        $_SESSION['canDownload'] = true;
    }
    //unset object and post var
    //unset($_POST['email']);
    //unset($logEntry);
    //header ("Location: member.php?p=getsources");
    print "<script>";
    print " self.location='../index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
}

?>
<link href="stylesheets/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
<div id="container">
<?php
  if(!isset($_SESSION['canDownload'])) {
  ?>
  <h3>Vpiši email in prenesi izvorno kodo</h3>
    <form action="member.php?p=getsources" class="required-form" method="post">
        <ol class="forms">
            <li>
                <label for="email"><em class="required">*</em> Email</label>
                <input type="text" name="email" id="email" class="required email" maxlength="40" /></li>
            </li>
            <li class="buttons"><button type="submit">Pošlji</button></li>
        </ol>
    </form>
    <?php
    } else {
    ?>
        <a href="<?=$file1?>"><?=$file1?></a> - primerno za PHP ver. 5.2 in manj<br />
        <a href="<?=$file2?>"><?=$file2?></a> - primerno za PHP ver. 5.3
    <?php
    }
  ?>
</div>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/jquery.simpleValidate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('form.required-form').simpleValidate({
		        errorElement: 'em'
	        });
        });
    </script>