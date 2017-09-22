<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 9.11.11
 * Time: 20:35
 * To change this template use File | Settings | File Templates.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <link href="stylesheets/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>
<body>
<div id="container">
  <h1>Log in</h1>
    <form action="login.php" class="required-form" method="post">
        <ol class="forms">
            <li>
                <label for="username"><em class="required">*</em> Uporabnik</label>
                <input type="text" name="username" id="username" class="required" minlength="4" maxlength="16" />
            </li>
            <li>
                <label for="password"><em class="required">*</em> Geslo</label>
                <input type="password" name="password" id="password" class="required" minlength="4" maxlength="16" />
            </li>
            <li class="buttons"><button type="submit">Log in</button></li>
        </ol>
    </form>
    <div id="authors">Uporabnik: <b>demo</b>, geslo: <b>demo</b> - Microblog 0.1c //namespaces by Samir Subašić &copy;2011</div>
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
</body>
</html>