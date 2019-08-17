<?php
$_POST['disable'] = "";
@session_start();
require_once "../php/db.php";
require_once "../php/function.php";
$data = get_index_photo();
$student = get_student();
$student_skills = get_student_skills();
$work = get_work();
$work_skills = get_work_skills();
?>
<?php


if (!isset($_SESSION['login']) || !$_SESSION['login']) {
  //直接轉跳到 login.php
  header("Location: ../login.php?msg=請正確登入");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BK-Admin</title>

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- materializecss icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <!-- jqury CDN -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <!-- font-awesom -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
  <!--css樣式-->
  <link rel="stylesheet" href="../css/style.css" charset="utf-8">

  <link rel="Shortcut Icon" type="image/x-icon" href="img/PBLAP_logo_small_c.png">


</head>

<body>

  <header>
    <?php include_once "menu.php" ?>
  </header>


  <main>
    <div class="row container">
      <form id="indexPhoto" class="col s12">
      <input type="hidden" id="id" value="<?php echo $data['id']; ?>">
        <div class="file-field input-field">
          <div class="btnEdit btn blue-grey lighten-5">
            <span class="black-text">照片</span>
            <input type="file" name="image_path" accept="image/gif, image/jpeg, image/png">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
          <input type="hidden" id="imgpath" value="">

        </div>

        <div class="row">
          <div class="col s6">
            <div class="col s12">
              <p>原始照片</p>
            </div>
            <div class="col s12">
              <img class="responsive-img showImg" src="../<?php echo ($data['photo_path']); ?>">
            </div>
          </div>
          <div class="col s6">
            <div class="col s12">
              <p>上傳照片</p>
            </div>
            <div class="col s12 newimg"></div>
            <button class="btn waves-effect waves-light red lighten-1 delete">
              刪除
            </button>
          </div>

        </div>


        <div class="input-field col s12">
          <input id="imgTitle" type="text" class="validate" value="<?php echo (ucfirst($data['username'])); ?>">
          <label for="imgTitle">主角</label>
        </div>


        <div class="row">
          <div class="input-field col s12">
            <textarea id="photoContent1" class="materialize-textarea" cols="30" rows="20"><?php echo ($data['content_one']); ?></textarea>
            <label for="photoContent1">第一段</label>
          </div>
        </div>


        <div class="row">
          <div class="input-field col s12">
            <textarea id="photoContent2" class="materialize-textarea" cols="30" rows="20"><?php echo ($data['content_two']); ?></textarea>
            <label for="photoContent2">第二段</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">存檔
          <i class="fas fa-save"></i>
        </button>
      </form>
    </div>

  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      //============================================================
      $('.sidenav').sidenav();
      //上傳圖片的input更動的時候
      $("input[name='image_path']").on("change", function() {
        //產生 FormData 物件
        var file_data = new FormData();
        var file_name = $(this)[0].files[0]['name'];
        var save_path = "img/";

        //   //在圖片區塊，顯示loading
        //   $("div.image").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

        //   //FormData 新增剛剛選擇的檔案
        file_data.append("file", $(this)[0].files[0]);
        file_data.append("save_path", save_path);
        //   //透過ajax傳資料
        $.ajax({
          type: 'POST',
          url: '../php/upload_file.php',
          data: file_data,
          cache: false, //因為只有上傳檔案，所以不要暫存
          processData: false, //因為只有上傳檔案，所以不要處理表單資訊
          contentType: false, //送過去的內容，由 FormData 產生了，所以設定false
          dataType: 'html'
        }).done(function(data) {
          console.log(data);
          //     //上傳成功
          if (data == "yes") {
            //       //將檔案插入
            $("div.newimg").html("<img class='responsive-img showImg' src='../" + save_path + file_name + "'>");
            //       //給予 #image_path 值，等等存檔時會用
            $("#imgpath").val(save_path + file_name);
            return false;
          }
          else if (data =="檔名重複")
          {
            alert("檔名重複，請更換檔名")
            location.reload() ;
          }   
          else 
          {
            //       //警告回傳的訊息
            alert(data);
          }

        }).fail(function(data) {
          //     //失敗的時候
          alert("有錯誤產生，請看 console log");
          console.log(jqXHR.responseText);
        });
      });

      //圖片刪除
      $("button.delete").on('click', function() {

        var c = confirm("確定要刪除新增照片嗎?")
        if (c) {
          if ($("#imgpath").val() != '') {
            $.ajax({
              type: 'POST',
              url: '../php/del_file.php',
              data: {
                file: $("#imgpath").val()
              },
              dataType: 'html'
            }).done(function(data) {
              console.log(data);
              $("#imgpath").val("");
              $("div.newimg img.showImg").fadeOut(500);
              setTimeout(function() {
                $("div.nwimg").html("");
              }, 500);
              $(".file-path").val("");
              location.reload() ;


            }).fail(function(data) {
              //失敗的時候
              alert("有錯誤產生，請看 console log");
              console.log(jqXHR.responseText);
            });
            return false;
          } else {
            alert("無檔案可以刪除");
            return false;
          }
        }
        else
        {
          alert("已取消")
          return false;
        }

      })


      $("form#indexPhoto").on('submit', function() {
        // alert($("#imgpath").val());
        // alert($("#imgTitle").val());
        // alert($("#photoContent1").val());
        // alert($("#photoContent2").val());


        $.ajax({
          type: "POST",
          url: "../php/updatephoto_index.php",
          data: {
            id         : $("#id").val(),
            username   : $("#imgTitle").val(),
            photo_path : $("#imgpath").val(),            
            content_one: $("#photoContent1").val(),
            content_two: $("#photoContent2").val(),
          },
          dataType: 'html'
        }).done(function(data) {

          //成功的時候
          if (data == "yes") {
            //註冊新增成功，轉跳到登入頁面。
            alert("更新成功");
            window.location.href = "index.php";
            return false;
          } 
          else if(data == "無更新")
          {
            alert("無更新");
            window.location.href = "index.php";
          }
          else 
          {
            alert("更新錯誤");
            console.log(data);
            return false;
          }

        }).fail(function(jqXHR, textStatus, errorThrown) {
          //失敗的時候
          alert("有錯誤產生，請看 console log");
          console.log(jqXHR.responseText);
        });


        return false;
      })


      //============================================================
    });
  </script>


</body>

</html>