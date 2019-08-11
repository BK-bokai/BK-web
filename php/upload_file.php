<?php
// print_r($_FILES);
// echo $_FILES['file']['name']; //第一個陣列索引值，是表單給予的 name="image_path" 而來的，第二個索引值 name 代表是上傳的檔案名稱
// echo $_FILES['file']['type'];      //檔案型態
// echo $_FILES['file']['tmp_name'];   //上傳後暫存在 server 的中的位置及檔名
// echo $_FILES['file']['error'];      //錯誤碼0,為上傳正常 4為沒選擇檔案
// echo $_FILES['file']['size'];		//檔案大小，以 byte 為單位
if(file_exists($_FILES['file']['tmp_name']))
{
   $img_folder = $_POST['save_path'];
   $file_name   = $_FILES['file']['name'];
  
   if(move_uploaded_file($_FILES['file']['tmp_name'], "../" . $img_folder .$file_name))
   {
      echo "yes";
   }
   else 
   {
      echo "檔案搬移失敗，請確認{$_POST['save_path']}資料夾可寫入";
   }

   $_POST['img_path'] = $img_folder . $file_name;
}
else 
{
   echo "暫存檔不存在，上傳失敗";
}



?>