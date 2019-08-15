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
      <form id="student" class="col s12">
        <input type="hidden" id="id" value="<?php echo $student['id']; ?>">
        <div class="row">
          <h3>內文</h3>
          <div class="input-field col s12">
            <textarea id="Content" class="materialize-textarea" cols="30" rows="20"><?php echo ($student['content']); ?></textarea>
          </div>
          <button class="btn waves-effect waves-light right" type="submit" name="action">存檔
            <i class="fas fa-save"></i>
          </button>
        </div>

      </form>

      <ul class="collection with-header">
        <li class="collection-header">
          <h4>技能列表
            <!-- <button id="addskill" class="btn waves-effect waves-light">新增技能  </button> -->
           </h4>
        </li>

        <?php foreach ($student_skills as $StudentSkill) : ?>
        <li class="collection-item">
          <div><?php echo ($StudentSkill['skill_name']) ?><a href="javascript:void(0);" class="skill_del secondary-content red-text" data-id="<?php echo $StudentSkill['id'] ?>"><i class="fas fa-trash"></i></a></div>
        </li>
        <?php endforeach ?>

        <!-- <li class="newskill_li collection-item"> -->
        <!-- <div class='newskill'><a href='javascript:void(0);' class='skill_del secondary-content red-text' data-id=''><i class='fas fa-trash'></i></a></div> -->
        <!-- </li> -->
        <!-- <div class='addarea'> -->
        <li class="collection-item">
          <div>shell script<a href="javascript:void(0);" class="skill_del secondary-content red-text" data-id="8"><i class="fas fa-trash"></i></a></div>
        </li>

        <!-- </div> -->

        <li class="collection-item">
          <form id='add_skill'>
            <div>
              <input name='addskill' type="text" placeholder="請輸入要新增的技能">
              <button class="btn waves-effect waves-light" type="submit">新增技能
                <i class="fas fa-save"></i>
              </button>
            </div>
          </form>
        </li>


      </ul>
    </div>

  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      //============================================================
      $('.sidenav').sidenav();

      $("form#student").on('submit', function() {
        alert($("#id").val());
        alert($("#Content").val());


        $.ajax({
          type: "POST",
          url: "../php/updatestudent.php",
          data: {
            id: $("#id").val(),
            content: $("#Content").val(),
          },
          dataType: 'html'
        }).done(function(data) {

          //成功的時候
          if (data == "yes") {
            //註冊新增成功，轉跳到登入頁面。
            alert("更新成功");
            // window.location.href = "index.php";
            return false;
          } else {
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

      //刪除技能
      $('.skill_del').on('click', function() {
        // alert($(this).attr('data-id'));
        var c = confirm("確定要刪除此技能嗎?");
        var this_tr = $(this).parent().parent();
        // alert($(this).attr('data-id'));
        if (c) {
          $.ajax({
            type: "POST",
            url: "../php/del_student_skill.php",
            data: {
              id: $(this).attr('data-id'),
            },
            dataType: 'html'
          }).done(function(data) {

            //成功的時候
            if (data == "yes") {
              //註冊新增成功，轉跳到登入頁面。
              alert("刪除成功");
              // window.location.href = "index.php";
              // $(this).parent().parent().fadeOut();
              $(this_tr).fadeOut();
              // alert($(this).parent().parent())
              return false;
            } else {
              alert("刪除錯誤");
              console.log(data);
              return false;
            }

          }).fail(function(jqXHR, textStatus, errorThrown) {
            //失敗的時候
            alert("有錯誤產生，請看 console log");
            console.log(jqXHR.responseText);
          });
        }

      })


      // //新增技能
      $("form#add_skill").on('submit', function() {
        alert($("input[name='addskill']").val());

        $.ajax({
          type: "POST",
          url: "../php/addstudentskill.php",
          data: {
            skill_name: $("input[name='addskill']").val(),
          },
          dataType: 'html'
        }).done(function(data) {

          //成功的時候
          if (data == "yes") {
            //註冊新增成功，轉跳到登入頁面。
            alert("更新成功");
            // window.location.href = "index.php";
            $("div.addarea").append("<li class='collection-item newskill_li'><div class='newskill'></div></li>")
            $(".newskill_li").prepend("<a href='javascript:void(0);' class='skill_del secondary-content red-text' data-id=''><i class='fas fa-trash'></i></a>")
            $(".newskill").prepend($("input[name='addskill']").val())

            return false;
          } else {
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