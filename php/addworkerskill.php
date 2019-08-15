<?php
require_once 'db.php';
require_once 'function.php';
$result=add_worker_skill($_POST['skill_name']);

if($result)
{
echo "yes";
}
else
{
echo "no";
}
?>