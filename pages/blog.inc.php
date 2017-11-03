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
}
include_once("classes/Microblog/Db/ReadFromDB.php");
/*if (isset($_POST['pageidx'])) {
    $pageidx = $_POST['pageidx'];
    echo "$pageidx from POST!";
} else {
    $pageidx = 1;
    echo "$pageidx default setted!";
}*/
?>
<div id="entries"></div>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript">
    //static header and menu height
    var headerAndMenuHeight = 125;
    //var pageIndex = 1;
    //var lastPageIndex = 3;
    //alert('Prva stran: ' + pageIndex + ', zadnja stran:' + lastPageIndex);

    //when page loads - samirs
    $(document).ready(function(){
        //adjust subpage hight
        var docHeight = $(window).height();
        var divHeight = docHeight - headerAndMenuHeight;
        $('#content').height(divHeight);

        //load blog entries - ajax call
        //alert(pageIndex + ' ' + lastPageIndex);
        $("#entries").load('ajaxLoadBlogs.php');
    });

    function setPrevious() {
        //alert('Berem podatke iz hidden - previous!');
        // get from hidden fields
        var pageIndex =  $('#pageidx').val();
        var lastPageIndex = $('#lastPageIdx').val();
        var previousPageIndex=1;
        var step = 1;

        if (pageIndex > 1) {
            previousPageIndex = eval(pageIndex) - eval(step);
        }
        $('#pageidx').val(previousPageIndex);
        //alert('Previous - pageIndex: ' + pageIndex);
        //alert('Predhodna stran: ' + previousPageIndex + ', zadnja stran:' + lastPageIndex);
        $('#entries').hide();
        $.post('ajaxLoadBlogs.php', $('#navform').serialize(),
          function(output) {
              $('#entries').html(output).fadeIn(1000);
        });
    }

    function setNext() {
        //alert('Berem podatke iz hidden - next!');
        // get from hidden fields
        var pageIndex =  $('#pageidx').val();
        var lastPageIndex = $('#lastPageIdx').val();
        var nextPageIndex = 0;
        var step = 1;

        if (pageIndex < lastPageIndex) {
            nextPageIndex = eval(pageIndex) + eval(step);
        }
        $('#pageidx').val(nextPageIndex);
        //alert('Next - pageIndex: ' + pageIndex);
        //alert('Naslednja stran: ' + nextPageIndex + ', zadnja stran:' + lastPageIndex);

        $('#entries').hide();
        $.post('ajaxLoadBlogs.php', $('#navform').serialize(),
          function(output) {
              $('#entries').html(output).fadeIn(1000);
        });
    }

    //when page resizes - samirs
    $(window).resize(function() {
        var docHeight = $(window).height();
        var divHeight = docHeight - headerAndMenuHeight;
        $('#content').height(divHeight);
    });

</script>