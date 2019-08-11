<?php
@session_start();

function get_index_photo()
{
   $data = array();
   $sql = "SELECT * FROM `index_photo` ";
   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_assoc($query);
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $data;
};

function get_student()
{
   $data = array();
   $sql = "SELECT * FROM `student`";
   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_assoc($query);
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $data;
};

function get_student_skills()
{
   $data = array();
   $sql = "SELECT * FROM `student_skills`";
   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_num_rows($query) > 0) {
         while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
         }
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $data;
}

function get_work()
{
   $data = array();
   $sql = "SELECT * FROM `worker`";
   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_assoc($query);
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $data;
}

function get_work_skills()
{
   $data = array();
   $sql = "SELECT * FROM `work_skills`";
   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_num_rows($query) > 0) {
         while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
         }
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $data;
}
function get_images()
{
   $data = array();
   $sql = "SELECT * FROM `images`";
   $query = mysqli_query($_SESSION['link'], $sql);
   if ($query) {
      if (mysqli_num_rows($query) > 0) {
         while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
         }
      }
   } else {
      echo ("{$sql}語法執行失敗，錯誤訊息:" . mysqli_error($_SESSION['link']));
   }
   return $data;
}

function check_user($un, $pw)
{
   $result = null;
   $pw = md5($pw);
   $sql = "SELECT * FROM `user` WHERE `username`= '{$un}' AND `password` = '{$pw}'";
   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_num_rows($query) == 1) {
         $user = mysqli_fetch_assoc($query);
         $_SESSION['login'] = true;
         $_SESSION['login_user_id'] = $user['id'];
         $result = true;
      }
   } else {
      echo ("{$sql}語法執行失敗，錯誤訊息:" . mysqli_error($_SESSION['link']));
   }
   return $result;
}

function update_index_photo($id, $username, $photo_path, $content_one, $content_two)
{
   $result = null;
   $photo_sql='';
   if($photo_path != '')
   {
      if(is_file("../".get_index_photo()['photo_path']))
      {
         unlink("../".get_index_photo()['photo_path']);
      }
      
      $photo_sql="`photo_path` = '{$photo_path}',";
   }

   $sql    = "UPDATE `index_photo` SET
               `username` = '{$username}',
               $photo_sql
               `content_one` = '{$content_one}',
               `content_two` = '{$content_two}'
               WHERE `id` = {$id};";

   $query = mysqli_query($_SESSION['link'],$sql);

   if($query)
   {
      if(mysqli_affected_rows($_SESSION['link']) == 1)
      {
         $result = true;
      }
   }
   else 
   {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
return $result;
}
