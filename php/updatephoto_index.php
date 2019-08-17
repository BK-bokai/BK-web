<?php
require_once 'db.php';
require_once 'function.php';
$result=update_index_photo($_POST['id'],$_POST['username'],$_POST['photo_path'],$_POST['content_one'],$_POST['content_two']);

if($result=="更新成功")
{
echo "yes";
}
elseif($result=="無更新")
{
echo "無更新";
}
else
{
echo "no";
}
?>