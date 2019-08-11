<?php
require_once "php/db.php";
require_once "php/function.php";
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
  <link rel="stylesheet" href="css/style.css" charset="utf-8">

  <link rel="Shortcut Icon" type="image/x-icon" href="img/PBLAP_logo_small_c.png">


</head>

<body>

  <header>
    <?php include_once "menu.php" ?>
  </header>


  <main>
    <div class="row container login">


      <form class="col s12 loginform">

        <div class="row">
          <div class="input-field col s12">
            <input id="username" type="text" class="validate un">
            <label for="username"><span class="member">帳號</span></label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="password" type="password" class="validate pw">
            <label for="password"><span class="member">密碼</span></label>
          </div>
        </div>

        <button class="btn waves-effect waves-light test" type="submit">登入
          <i class="material-icons right">send</i>
        </button>
      </form>
    </div>
  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
      $('.carousel').carousel();
      M.updateTextFields();



      //       以下開始是登入動作
      $('form.loginform').on('submit', function() {
        alert("submit");
        
        $.ajax({
          type: "POST",
          url: "php/check.php",
          data: {
            un: $(".un").val(),
            pw: $(".pw").val()
          },
          dataType: 'html'
        }).done(function(data) {
          console.log(data)
          if (data == 'yes') {
            alert('登入成功');
            window.location.href='qwewqa=admin/index.php';
          } else {
            alert('登入失敗，請確認帳號密碼');
          }
        }).fail(function(jqXHR, textStatus, errorThrown) {
          alert("有錯誤產生，請看 console log");
          console.log(jqXHR.responseText);
        })

        return false;

      });

    })
  </script>


</body>

</html>