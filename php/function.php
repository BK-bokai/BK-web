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

function get_web()
{
   $data = array();
   $sql = "SELECT * FROM `web`";
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
function get_publish_images()
{
   $data = array();
   $sql = "SELECT * FROM `images` WHERE `publish` = 1";
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
   $photo_sql = '';
   $updatecon1 = '';
   $updatecon2 = '';
   $sqlname = '';

   if ($photo_path != '') {
      if (is_file("../" . get_index_photo()['photo_path'])) {
         unlink("../" . get_index_photo()['photo_path']);
      }

      $photo_sql = "`photo_path` = '{$photo_path}'";
   }
   $data = get_index_photo();

   if ($data['content_one'] != $content_one) {
      $updatecon1 = "`content_one` = '{$content_one}'";
   } else {
      $updatecon1 = '';
   }

   if ($data['content_two'] != $content_two) {
      $updatecon2 = "`content_two` = '{$content_two}'";
   } else {
      $updatecon2 = '';
   }

   if ($data['username'] != $username) {
      $sqlname = "`username` = '{$username}'";
   } else {
      $sqlname = '';
   }

   if ($photo_sql || $updatecon1 || $updatecon2 || $sqlname ) {
      

      // $sql    = "UPDATE `index_photo` SET".''.
      //          $sqlname.($photo_sql)? ",":'' . ''.
      //          $photo_sql.($updatecon1)? ",":'' . ''.
      //          $updatecon1.($updatecon2)? ",":'' . ''.
      //          $updatecon2.''.
      //          "WHERE `id` = {$id};";

      $a='';
      $b='';
      $c='';
      
      if($sqlname) $a= ( $photo_sql || $updatecon1 || $updatecon2 ) ? ",":'' ;
      if($photo_sql) $b= ($updatecon1 || $updatecon2 ) ? ",":'' ;
      if($updatecon1) $c= ($updatecon2 ) ? ",":'' ;

      $sql    = "UPDATE `index_photo` SET".
               $sqlname. $a.
               $photo_sql. $b.
               $updatecon1. $c.
               $updatecon2.
               "WHERE `id` = {$id};";
   } else {
      $sql = '';
   }

   if ($sql) {
      $query = mysqli_query($_SESSION['link'], $sql);

      if ($query) {
         if (mysqli_affected_rows($_SESSION['link']) == 1) {
            $result = "更新成功";
         }
      } else {
         echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
      }
   }
   else
   {
      $result = "無更新";
   }
   return $result;
}

function update_student($id, $content)
{
   $result = null;


   $sql    = "UPDATE `student` SET
               `content` = '{$content}'
               WHERE `id` = {$id};";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}

function update_worker($id, $content)
{
   $result = null;


   $sql    = "UPDATE `worker` SET
               `content` = '{$content}'
               WHERE `id` = {$id};";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}

function del_student_skill($id)
{
   $result = null;
   $sql = "DELETE FROM `student_skills` WHERE `id` = {$id} ";
   $query = mysqli_query($_SESSION['link'], $sql);


   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}

function del_worker_skill($id)
{
   $result = null;
   $sql = "DELETE FROM `work_skills` WHERE `id` = {$id} ";
   $query = mysqli_query($_SESSION['link'], $sql);


   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}


function add_student_skill($skill_name)
{

   $result = null;
   $create_time = date("Y-m-d H:i:s");

   $sql = "INSERT INTO `student_skills` (`skill_name`, `create_time`) VALUE ('{$skill_name}', '{$create_time}');";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {

         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }

   return $result;
}

function add_worker_skill($skill_name)
{

   $result = null;
   $create_time = date("Y-m-d H:i:s");

   $sql = "INSERT INTO `work_skills` (`skill_name`, `create_time`) VALUE ('{$skill_name}', '{$create_time}');";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {

         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }

   return $result;
}

function add_img($imgpath, $publish)
{

   $result = null;
   $create_time = date("Y-m-d H:i:s");

   $sql = "INSERT INTO `images` (`image_path`, `publish`, `create_time`) VALUE ('{$imgpath}', {$publish}, '{$create_time}');";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {

         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }

   return $result;
}

function del_img($id)
{
   $img = get_img($id);
   if (is_file('../' . $img['image_path'])) {
      unlink('../' . $img['image_path']);
   } else {
      echo "檔案不存在";
   }


   $result = null;
   $sql = "DELETE FROM `images` WHERE `id` = {$id} ";
   $query = mysqli_query($_SESSION['link'], $sql);


   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}

function get_img($id)
{
   $data = array();
   $sql = "SELECT * FROM `images` WHERE `id` = {$id} ";
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

function update_image($id, $publish)
{
   $result = null;


   $sql    = "UPDATE `images` SET
               `publish` = '{$publish}'
               WHERE `id` = {$id};";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}

function get_members()
{
   $data = array();
   $sql = "SELECT * FROM `user`";
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

function check_username($un)
{
   $result=false;
   $users=get_members();
   foreach($users as $user)
   {
      if($user['username']==$un)
      {
         $result=true;
      }
   }
   return $result;
}

function check_useremail($email)
{
   $result=false;
   $users=get_members();
   foreach($users as $user)
   {
      if($user['email']==$email)
      {
         $result=true;
      }
   }
   return $result;
}


function create_user($n,$un,$pa,$em,$lev)
{

   $result = null;
   $password=md5($pa);


   $sql = "INSERT INTO `user` (`username`, `password`, `name`, `email`, `level`) VALUE ('{$un}', '{$password}', '{$n}', '{$em}', '{$lev}');";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {

         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }

   return $result;
}

function del_mem($id)
{
   $result = null;
   $sql = "DELETE FROM `user` WHERE `id` = {$id} ";
   $query = mysqli_query($_SESSION['link'], $sql);


   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}

function add_web($title, $url)
{

   $result = null;
   $create_time = date("Y-m-d H:i:s");

   $sql = "INSERT INTO `web` (`title`, `web_side`, `create_time`) VALUE ('{$title}', '{$url}', '{$create_time}');";

   $query = mysqli_query($_SESSION['link'], $sql);

   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {

         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }

   return $result;
}

function del_work($id)
{
   $result = null;
   $sql = "DELETE FROM `web` WHERE `id` = {$id} ";
   $query = mysqli_query($_SESSION['link'], $sql);


   if ($query) {
      if (mysqli_affected_rows($_SESSION['link']) == 1) {
         $result = true;
      }
   } else {
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
   }
   return $result;
}
