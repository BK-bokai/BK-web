<?php
@session_start();
require_once "../php/db.php";
require_once "../php/function.php";
$webs = get_web();
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
  <title>BK</title>

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

    <div class="work_list row collection container">

      <?php foreach ($webs as $web) : ?>
      <div class="col s8">
        <a href="<?php echo $web['web_side'] ?>" target="_blank" class="collection-item">
          <?php echo $web['title'] ?>
        </a>
      </div>
      <div class="col s4">
        <button class="btn waves-effect waves-light red del_work right">刪除
          <i class="fas fa-trash-alt"></i>
        </button>
      </div>
      <?php endforeach ?>

    </div>

    <div class="webadd row container">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s6">
            <input id="title" type="text" class="validate" required>
            <label for="title">標題</label>
          </div>
          <div class="input-field col s6">
            <input id="web" type="text" class="validate" required>
            <label for="web">網址</label>
          </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="action">存檔
          <i class="fas fa-save"></i>
        </button>
      </form>
    </div>

    <!-- <div class="fixed-action-btn">
      <a class="btn-floating btn-large red">
        <i class="large material-icons">mode_edit</i>
      </a>

      <ul>
        <li><a class="btn-floating red" href="https//gmail.com"><i class="material-icons">insert_chart</i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
        <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
        <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
      </ul>
    </div> -->
  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('input#input_text, textarea#textarea2').characterCounter();
      $('.sidenav').sidenav();
      $('.carousel').carousel({

      });
      $('.fixed-action-btn').floatingActionButton();

      $("form").on('submit', function() {
        alert($('input#title').val())
        alert($('input#web').val())
        $.ajax({
          type: "POST",
          url: "../php/addweb.php",
          data: {
            title: $('input#title').val(),
            url: $('input#web').val()

          },
          dataType: 'html'
        }).done(function(data) {
          //成功的時候
          if (data == "yes") {
            //註冊新增成功，轉跳到登入頁面。
            alert("新增成功");
            location.reload();
            // window.location.href = "images.php";
            return false;
          } else {
            alert("新增失敗");
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


    });
  </script>


</body>

</html>