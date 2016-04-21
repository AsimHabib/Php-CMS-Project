<?php
//To keep the session alive this file is required
session_start();

$page_title = 'COMP1006 Web Application | Page Not Found';
require_once('header_main.php');
?>

<div class="jumbotron">
    <h3>Error 404 - Sorry about the error!</h3>
    <p>We can not find the page you requested. Try one of the link above</p>
</div>

<?php
require_once('footer.php');
?>