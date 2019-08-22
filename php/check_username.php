<?php
require_once "db.php";
require_once "function.php";

if(check_username($_POST['un']))
{
   echo 'no';
}
else 
{
   echo 'yes';
}



?>