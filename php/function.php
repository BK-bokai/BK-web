<?php
@session_start();

function get_index_photo()
{
               $data = array();
               $sql = "SELECT * FROM `index_photo` ";
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
};

function get_student()
{
               $data = array();
               $sql = "SELECT * FROM `student`";
               $query = mysqli_query($_SESSION['link'], $sql);

               if ($query) 
               { 
                              if(mysqli_num_rows($query)>0)
                              {
                                             while ($row = mysqli_fetch_assoc($query))
                                             {
                                                            $data[]=$row;
                                             }
                              }
               }
               else 
               {
                              echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']); 
               }
               return $data;
};

function get_student_skills()
{
               $data=array();
               $sql="SELECT * FROM `student_skills`";
               $query=mysqli_query($_SESSION['link'],$sql);

               if ($query) 
               {
                         if(mysqli_num_rows($query)>0)
                         {
                                        while($row = mysqli_fetch_assoc($query))
                                        {
                                                       $data[]=$row;
                                        }
                         }     
               }
               else 
               {
                              echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);     
               }
               return $data;
}

function get_work()
{
               $data=array();
               $sql="SELECT * FROM `worker`";
               $query=mysqli_query($_SESSION['link'],$sql);

               if($query)
               {
                              if(mysqli_num_rows($query)>0)
                              {
                                             while($row=mysqli_fetch_assoc($query))
                                             {
                                                            $data[]=$row;
                                             }
                              }
               }
               else 
               {
                              echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
               }
               return $data;
}

function get_work_skills()
{
               $data=array();
               $sql="SELECT * FROM `work_skills`";
               $query=mysqli_query($_SESSION['link'],$sql);

               if($query)
               {
                              if(mysqli_num_rows($query)>0)
                              {
                                             while($row=mysqli_fetch_assoc($query))
                                             {
                                                            $data[]=$row;
                                             }
                              }
               }
               else 
               {
                              echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
               }
               return $data;
}
function get_images()
{
               $data=array();
               $sql="SELECT * FROM `images`";
               $query=mysqli_query($_SESSION['link'],$sql);
               if($query)
               {
                              if(mysqli_num_rows($query)>0)
                              {
                                             while($row=mysqli_fetch_assoc($query))
                                             {
                                                            $data[]=$row;
                                             }
                              }
               }
               else 
               {
                              echo ("{$sql}語法執行失敗，錯誤訊息:" . mysqli_error($_SESSION['link']));              
               }
               return $data;
}