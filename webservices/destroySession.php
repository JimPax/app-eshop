<?php
session_id('login');
session_start();
session_destroy();
session_commit();
?>