<?php
require_once "db.php";
require_once "function.php";

if(check_user($_POST['un'],$_POST['pw']))
{
   echo 'yes';
}
else 
{
   echo 'no';
}



?>