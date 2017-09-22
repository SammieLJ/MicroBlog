<?php
if(!isset($_SESSION)) {
     session_start();
}
if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='../index.php';"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='../index.php'>Click here</a> for login! ");
    //require_once "include/warrningDiv.inc.php";
    //die($warrningDivStart . "You must be logged in! <a href='../index.php'>Click here</a> for login! " . $warrningDivEnd);
}

$warrningDivStart = "<link href=\"stylesheets/member.css\" type=\"text/css\" rel=\"stylesheet\" media=\"screen,projection\" /><div id='entry'><h3>Sporočilo!</h3>";
$warrningDivEnd = "</div>";
if ($_SESSION['username'] === 'demo') {
    die($warrningDivStart . "Uporabniku <b>demo</b> ne morete spreminjati gesla!" . $warrningDivEnd);
}
?>
<link href="stylesheets/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
<div id="container">
  <h3>Spremeni geslo</h3>
    <form action="acceptPasswordChange.php" class="required-form" method="post">
        <ol class="forms">
            <li>
                <label for="oldPassword"><em class="required">*</em> Staro geslo:</label>
                <input type="password" name="oldPassword" id="oldPassword" class="required" minlength="4" minlength="16" />
            </li>
            <li>
                <label for="newPassword1"><em class="required">*</em> Novo geslo: </label>
                <input type="password" name="newPassword1" id="newPassword1" class="required" minlength="4" minlength="16" />
            </li>
            <li>
                <label for="newPassword2"><em class="required">*</em> Ponovi geslo: </label>
                <input type="password" name="newPassword2" id="newPassword2" class="required" minlength="4" minlength="16" />
            </li>
            <li class="buttons"><button type="submit">Pošlji</button></li>
        </ol>
    </form>
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