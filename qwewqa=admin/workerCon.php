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
      <form id="worker" class="col s12">
        <input type="hidden" id="id" value="<?php echo $work['id']; ?>">
        <div class="row">
          <h3>內文</h3>
          <div class="input-field col s12">
            <textarea id="Content" class="materialize-textarea" cols="30" rows="20"><?php echo ($work['content']); ?></textarea>
          </div>
          <button class="btn waves-effect waves-light right" type="submit" name="action">存檔
            <i class="fas fa-save"></i>
          </button>
        </div>

      </form>
    </div>

  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      //============================================================
      $('.sidenav').sidenav();

      $("form#worker").on('submit', function() {
        alert($("#id").val());
        alert($("#Content").val());


        $.ajax({
          type: "POST",
          url: "../php/updateworker.php",
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
            window.location.href = "index.php";
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