<?php
require_once("include/session.php");
require_once("include/warrningDiv.inc.php");

//prikaz nasih sumnikov
echo "<meta charset=\"utf-8\" />";

if (!isset($_SESSION['username'])) {
    //forward to index.php
    print "<script>";
    print " self.location='index.php'"; // Comment this line if you don't want to redirect
    print "</script>";
    die("You must be logged in! <a href='index.php'>Click here</a> for login! ");
} else {
if(isset($_SESSION['userlevel'])&&$_SESSION['userlevel']<1) {

    include_once("classes/Microblog/Db/ReadFromDB.php");

    //user list
    $userList = array();
    $usersListDB = new ReadFromDB();
    $userList = $usersListDB->getUsersList();
    unset($usersListDB);  //unload object

    //user role list
    $userRoleList = array();
    $usersRoleListDB = new ReadFromDB();
    $userRoleList = $usersRoleListDB->getUserRolesList();
    unset($usersRoleListDB);  //unload object

     /* check if we have some entries */
if (empty($userList)) {
?>
    <div id="entry"><h3>V seznamu ni nobenega uporabnika!</h3></div>
<?php
} else {
?>
<link href="stylesheets/member.css" type="text/css" rel="stylesheet" media="screen,projection" />
<link href="stylesheets/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />

<div id="container">
  <h3>Uporabniške nastavitve&nbsp;&nbsp;&nbsp;<a href="member.php">[nazaj na blog]</a></h3>
  <form action="acceptUserChanges.php" id="addNewUser" class="required-form" method="post">
  	<ol class="forms">
  		<li><label for="username"><em class="required">*</em> Uporabnik</label><input type="text" name="username" id="username" class="required" minlength="4" maxlength="15" /></li>
  		<li><label for="userpassword"><em class="required">*</em> Geslo</label><input type="password" name="userpassword" id="userpassword" class="required" minlength="4" maxlength="15" /></li>
  		<li><label for="userlevel"><em class="required">*</em> Stopnja</label>
            <select name="userlevel" id="userlevel">
            <?php foreach($userRoleList as $key=>$value) { ?>
                <option value="<?=$key?>"><?=$value?></option>
            <?php } ?>
            </select>
        </li>
  		<li class="buttons"><button type="submit">Dodaj uporabnika</button></li>
  	</ol>
  </form>

    <table cellpadding="5" cellspacing="5" id="resultTable" width="100%">
    <thead>
        <tr><th align="left">#</th><th align="left">Uporabnik</th><th align="left">Geslo</th><th align="left">Št. vloge</th><th align="left">Vloga</th><th align="left">Deaktivacija</th></tr>
    </thead>
    <tbody>
    <?php /* print all microblog entries */
    $numrow = 1;
    foreach ($userList as $value) {
    ?>
        <tr><td><?=$value->getIdUser()?></td>
            <td><?=$value->getUsersName()?></td>
            <td><?=$value->getUsersPassword()?></td>
            <td align="right"><?=$value->getUsersLevel()?></td>
            <td><?=$value->getRoleDesc()?></td>
            <?php
            if ($value->getUsersName() === 'demo' && $value->getUsersPassword() === 'demo') {
            ?>
            <td>Ni izbire!</td>
            <?php
            } else {
            ?>
            <td><a href="#" id="select1" onclick="readValue(<?=$numrow?>);">Izberi</a></td>
            <?php
            }
            ?>
        </tr>
    <?php
        $numrow++;
    }
    ?>
    </tbody>
    </table>
    <form action="acceptUserChanges.php" method="post" id="deleteUser">
        <label for="usernameToDelete">Izbran uporabnik: </label>
        <span id="usernameToDelete">?</span>
        <input type="hidden" name="userIdToDelete" id="userIdToDelete" /><br />
        <button type="button" id="cancelButton">Razveljavi izbrano</button>
        <button type="submit" id="deleteButton">Deaktiviraj uporabnika</button>
    </form>
</div>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/jquery.simpleValidate.min.js"></script>
    <script type="text/javascript">
        $('form.required-form').simpleValidate({
	        errorElement: 'em'
	    });
        $(document).ready(function() {
          zebraRows('tbody tr:odd td', 'odd');

        });
         $('#cancelButton').click(function(){
	        $('#userIdToDelete').val('Undefined');
            $('#usernameToDelete').text('?');
	    });
        $('#deleteButton').click(function(){
            if ($('#userIdToDelete').val() === 'Undefined' || $('#userIdToDelete').val() === NaN || $('#userIdToDelete').val().length === 0) {
                alert('Noben uporabnik ni izbran za brisanje!');
                return false;
            } else {
                return true;
            }
	    });

        //used to apply alternating row styles
        function zebraRows(selector, className)
        {
          $(selector).removeClass(className).addClass(className);
        }

        //used do read values from selected row
        function readValue(number) {
            //userid
            var cell = $('table tr:eq('+number+') td:eq('+0+')');
			if (cell.length == 0) {
                $('#userIdToDelete').val('Undefined')
			}
			else {
                $('#userIdToDelete').val(cell.text());
            }

            //username
            var cell = $('table tr:eq('+number+') td:eq('+1+')');
			if (cell.length == 0) {
                $('#usernameToDelete').text('Undefined')
			}
			else {
                $('#usernameToDelete').text(cell.text());
            }
        }
    </script>

<?php
      }
    } else {
        echo "Nimaš ustreznih pravic! Pojdi <a href=\"javascript:history.go(-1)\">nazaj!</a>";
    }
}
?>

