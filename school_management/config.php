<?php
ob_start();
if(!session_start()){
    session_start();
}

$dbh=new PDO("mysql:dbhost=localhost;dbname=schoolManagement","root","");
if($dbh):
    return TRUE;
endif;
return False;

