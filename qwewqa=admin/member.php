<?php
@session_start();
require_once "../php/db.php";
require_once "../php/function.php";

$members = get_members();
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
      <div class="col s12 memberList">
        <table class="highlight centered">
          <thead>
            <tr>
              <th>id</th>
              <th>名字</th>
              <th>帳號 </th>
              <th>操作</th>
            </tr>
          </thead>
          <?php foreach ($members as $member) : ?>
          <tbody>
            <tr>
              <td><?php echo $member['id'] ?></td>
              <td><?php echo $member['name'] ?></td>
              <td><?php echo $member['username'] ?></td>
              <td> <button data-id="<?php echo $member['id'] ?>" class=" del-btn btn waves-effect waves-light red del_img ">刪除</td>
            </tr>
          </tbody>
          <?php endforeach ?>
        </table>
        <a href="addmember.php" class="btn tooltipped btn-floating btn-large waves-effect waves-light black pulse" data-position="bottom" data-tooltip="新增會員">
          <i class="material-icons">add</i>
        </a>

      </div>
    </div>

  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
      $('.tooltipped').tooltip();

      $('.tooltipped').on('click', function() {
        // window.location.href = "addmember.php"
        window.location.href = "addmember.php";
        // $(window).attr('location','addmember.php');
      })

      $('.del-btn').on('click', function() {
        // alert($(this).attr('data-id'))
        var c = confirm("你確定要刪除此會員嗎?")
        if (c) {
          var this_tr=$(this).parent().parent();
          $.ajax({
            type: "POST",
            url: "../php/del_mem.php",
            data: {
              id: $(this).attr('data-id'),
            },
            dataType: 'html'
          }).done(function(data) {

            //成功的時候
            if (data == "yes") {
              alert("刪除成功");
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

    });
  </script>


</body>

</html>