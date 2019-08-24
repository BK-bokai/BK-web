<?php
require_once "db.php";
require_once "function.php";

if(del_work($_POST['id']))
{
   echo 'yes';
}
else 
{
   echo 'no';
}


?>