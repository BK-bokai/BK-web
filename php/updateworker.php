<?php
require_once 'db.php';
require_once 'function.php';
$result=update_worker($_POST['id'],$_POST['content']);

if($result)
{
echo "yes";
}
else
{
echo "no";
}
?>