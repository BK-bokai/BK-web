<?php
require_once 'db.php';
require_once 'function.php';
$result=add_img($_POST['imgpath'],$_POST['publish']);

if($result)
{
echo "yes";
}
else
{
echo "no";
}
?>