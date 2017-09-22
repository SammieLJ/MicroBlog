<?php
if(!isset($_SESSION)) {
     session_start();
}
if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='../index.php';"; // Comment this line if you don't want to redirect - samirs
    print "</script>";
    die("You must be logged in! <a href='../index.php'>Click here</a> for login! ");
} else {
    echo "<meta charset=\"utf-8\" />";
    if (isset($_GET['entryId'])) {
        $entryId = $_GET['entryId'];
    }

    if(isset($_SESSION['userlevel']) && $_SESSION['userlevel']<2) {
        //if (isset($_SESSION['entryId']) && !empty($_SESSION['entryId'])) {
        if (isset($entryId) && !empty($entryId)) {
            include_once('classes/Microblog/Db/ReadFromDB.php');
            $entryObj = new ReadFromDB();
            //$entryId = intval($_SESSION['entryId']);
            $entry = $entryObj->getEntry($entryId);
            unset($entryObj);
            unset($_SESSION['entryId']);
        }

?>
<link href="stylesheets/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
<div id="container">
  <h3>Vnos Microblog-a</h3>
  <form action="acceptEntry.php" class="required-form" method="post">
  	<ol class="forms">
  		<li><label for="headline"><em class="required">*</em> Naslov</label><input type="text" name="headline" id="headline" class="required" maxlength="60" value='<?=isset($entry) ? $entry->getHeadline() : '' ?>' /></li>
  		<li><label for="email"><em class="required">*</em> Email</label><input type="text" name="email" id="email" class="required email" maxlength="40" value='<?=isset($entry) ? $entry->getEmail() : '' ?>' /></li>
  		<li><label for="weburl"><em class="required">*</em> Spletna stran</label><input type="text" name="website" id="weburl" class="required weburl" maxlength="60" value='<?=isset($entry) ? $entry->getWeburl() : '' ?>' /></li>
  		<li><label for="comment"><em class="required">*</em> Vsebina</label><textarea name="comment" id="comment" class="required"  maxlength="321" ><?=isset($entry) ? $entry->getBody() : '' ?></textarea></li>
  		<li class="buttons"><button type="submit">Pošlji</button></li>
  	</ol>
    <input type="hidden" name="entryID" value='<?=isset($entry) ? $entry->getEntryId() : ''?>' />
  </form>
</div>
<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/jquery.simpleValidate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('form.required-form').simpleValidate({
	  errorElement: 'em'
	});
});
</script>
<?php
    } else {
        echo "Nimaš ustreznih pravic! Pojdi <a href=\"javascript:history.go(-1)\">nazaj</a>!";
    }
}

?>

