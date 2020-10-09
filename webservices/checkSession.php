<?php
session_start();
if( $_SESSION['login'] == "admin" ){
    print 'admin';
}
else
{
    print 'user';
}
?>