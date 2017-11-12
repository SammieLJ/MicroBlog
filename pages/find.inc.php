<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 18.11.11
 * Time: 0:28
 * To change this template use File | Settings | File Templates.
 */

?>
<link href="stylesheets/screen.css" type="text/css" rel="stylesheet" media="screen,projection" />
<div id="container">
<h3>Iskanje po Microblog-u</h3>
<form id="find" name="find" class="required-form" method="post" action="searchedBlogs.php">
    <ol class="forms">
        <li><label for="headline">Naslov bloga </label><input type="text" name="headline" id="headline" /></li>
        <li><label for="body">Vsebina bloga </label><input type="text" name="body" id="body" /></li>
        <li><label for="email">Email avtorja </label><input type="text" name="email" id="email" /></li>
        <li><label for="weburl">Spletni naslov </label><input type="text" name="weburl" id="weburl" /></li>
        <li class="buttons"><button type="submit" name="send" id="send">Išči!</button></li>
    </ol>
    <input type="hidden" id="page" name="page" value="find" />
</form>
</div>