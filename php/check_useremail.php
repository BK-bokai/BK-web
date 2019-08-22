<?php
require_once "db.php";
require_once "function.php";

if(check_useremail($_POST['email']))
{
   echo 'no';
}
else 
{
   echo 'yes';
}



?>