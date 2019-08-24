<?php
require_once 'db.php';
require_once 'function.php';
$result=add_web($_POST['title'],$_POST['url']);

if($result)
{
echo "yes";
}
else
{
echo "no";
}
?>