<?php
@session_start();
require_once "php/db.php";
require_once "php/function.php";

$members = get_members();
?>
<?php

if (isset($_SESSION['login']) && $_SESSION['login']) {
  header("Location: qwewqa=admin/index.php");
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
  <link rel="stylesheet" href="css/style.css" charset="utf-8">

  <link rel="Shortcut Icon" type="image/x-icon" href="img/PBLAP_logo_small_c.png">


</head>

<body>

  <header>
    <?php include_once "menu.php" ?>
  </header>


  <main>
    <div class="row container">
      <form class="col s12 ">


        <div class="row">
          <div class="input-field col s12">
            <input id="name" type="text" class="validate un black-text">
            <label for="name"><span>名稱</span></label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="username" type="text" class="validate">
            <label for="username"><span>帳號</span></label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="password" type="password" class="validate">
            <label for="password"><span>密碼(8~10碼含英文)</span></label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="repassword" type="password" class="validate">
            <label for="repassword"><span>確認密碼</span></label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="text" class="validate">
            <label for="email"><span>電子信箱</span></label>
          </div>
        </div>

        <div class="input-field col s12">
          <select>
            <!-- <option value="" disabled selected>level3</option> -->
            <option value="3" selected>level3</option>
          </select>
          <label>選擇管理權限</label>
        </div>

        <div class="row">
          <div class="col s6">
            <button class="btn waves-effect waves-light test" type="submit">註冊
              <i class="material-icons right">send</i>
            </button>

          </div>

        </div>
      </form>
    </div>

  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
      $('.tooltipped').tooltip();
      $('select').formSelect();




      $('form').on('submit', function() {
        var username = false;
        var password = false;
        var email = false;
        var name = false;
        if ($('#name').val() == '') {
          alert('請填入名稱欄位');
          $("#name").parent().addClass('errorun');
        }
        else
        {
          name = true
        }

        if ($('#username').val() == '') {
          alert('請填入帳號');
          $("#username").parent().addClass('errorun');
          // var username = false;
        }


        if ($('#email').val() == '') {
          alert("請填入email");
          $("#email").parent().addClass('errorun');

        }

        $.ajax({
          type: "POST", //表單傳送的方式 同 form 的 method 屬性
          url: "php/check_username.php", //目標給哪個檔案 同 form 的 action 屬性
          data: { //為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
            un: $('#username').val() //代表要傳一個 n 變數值為，username 文字方塊裡的值
          },
          dataType: 'html', //設定該網頁回應的會是 html 格式
          async: false,
        }).done(function(data) {
          //成功的時候
          //console.log(data); //透過 console 看回傳的結果
          if (data == "yes") {
            username = true;
          } else {
            alert("帳號有重複，不可以註冊");
            $("#username").parent().addClass('errorun');
            // var username = false;
          }
        }).fail(function(jqXHR, textStatus, errorThrown) {
          //失敗的時候
          alert("有錯誤產生，請看 console log");
          console.log(jqXHR.responseText);
        });


        if (($('#password').val()).length < 8 | $('#password').val() != $('#repassword').val()) {
          if (($('#password').val()).length < 8) {
            alert('密碼小於8碼');
            $("#password").parent().addClass('errorunpas')
            $("#repassword").parent().addClass('errorunpas')
          }

          if ($('#password').val() != $('#repassword').val()) {
            alert('兩次密碼不同');
            $("#password").parent().addClass('errorunpas')
            $("#repassword").parent().addClass('errorunpas')
          }

        } else {
          password = true;
        }

        $.ajax({
          type: "POST", //表單傳送的方式 同 form 的 method 屬性
          url: "php/check_useremail.php", //目標給哪個檔案 同 form 的 action 屬性
          data: { //為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
            email: $('#email').val() //代表要傳一個 n 變數值為，username 文字方塊裡的值
          },
          dataType: 'html', //設定該網頁回應的會是 html 格式
          async: false,
        }).done(function(data) {
          if (data == "yes") {
            email = true;
          } else {
            alert("email有重複，不可以註冊");
            $("#email").parent().addClass('errorun');
            // var email = false;

          }
        }).fail(function(jqXHR, textStatus, errorThrown) {
          //失敗的時候
          alert("有錯誤產生，請看 console log");
          console.log(jqXHR.responseText);
        });

        console.log('username is' +''+ username);
        console.log('password is' +''+ password);
        console.log('email is' +''+ email);
        console.log('name is' +''+ name);

        if (username && password && email && name) {
          alert('此帳密可使用')

          $.ajax({
            type: "POST", //表單傳送的方式 同 form 的 method 屬性
            url: "php/people_create_user.php", //目標給哪個檔案 同 form 的 action 屬性
            data: { //為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
              n: $('#name').val(),
              un: $('#username').val(),
              pa: $('#password').val(),
              email: $('#email').val(),
              level: $('select').val(),
            },
            dataType: 'html', //設定該網頁回應的會是 html 格式
            async: true,
          }).done(function(data) {
            //成功的時候
            //console.log(data); //透過 console 看回傳的結果
            if (data == "yes") {
              alert("註冊成功");
              window.location.href = "qwewqa=admin/index.php";
            } else {
              alert('系統有問題，請通知客服')

            }
          }).fail(function(jqXHR, textStatus, errorThrown) {
            //失敗的時候
            alert("有錯誤產生，請看 console log");
            console.log(jqXHR.responseText);
          });
        }





        return false;
      })


    });
  </script>



</body>

</html>