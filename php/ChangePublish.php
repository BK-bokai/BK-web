<?php
require_once 'db.php';
require_once 'function.php';
$result=update_image($_POST['id'],$_POST['publish']);

if($result)
{
echo "yes";
}
else
{
echo "no";
}
?>