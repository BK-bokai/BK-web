<?php
if (file_exists("../" . $_POST['file'])) 
{
   unlink("../" . $_POST['file']);
   echo "yes";
}
else 
{
   echo "檔案不存在";
}

?>