<?php
@session_start();
require_once "../php/db.php";
require_once "../php/function.php";
$images = get_images();
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
      <div class="col s12" id="addimg">
        <a class="waves-effect waves-light btn " href='addimg.php'><i class="fas fa-images"></i>新增相片</a>
      </div>
      <?php foreach ($images as $img) : ?>
      <div class="img_box col s12 m3">
        <form data-id="<?php echo $img['id'] ?>">
          <div class="col s12">
            <img class="responsive-img" src="<?php echo ('../' . $img['image_path']) ?>">
          </div>
          <div class="col s12">
            <label>
              <input class="with-gap" name="publish" type="radio" <?php echo ($img['publish'] == 1) ? "checked" : "" ?> />
              <span>發佈</span>
            </label>
            <label>
              <input class="with-gap" name="publish" type="radio" <?php echo ($img['publish'] == 0) ? "checked" : "" ?> />
              <span>不發佈</span>
            </label>
          </div>
          <div class="col s12 center">
            <button class="btn waves-effect waves-light red del_img" type="submit" name="action">刪除
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </form>
      </div>


      <?php endforeach ?>

    </div>
  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();

      $('form').on('submit',function(){
        alert($(this).attr('data-id'));
        var this_tr = $(this).parent();
        var c=confirm('你確定要刪除此照片嗎')

        if (c) {
          $.ajax({
            type: "POST",
            url: "../php/del_img.php",
            data: {
              id: $(this).attr('data-id'),
            },
            dataType: 'html'
          }).done(function(data) {

            //成功的時候
            if (data == "yes") 
            {
              alert("刪除成功");
              $(this_tr).fadeOut();
              // alert($(this).parent().parent())
              return false;
            }
            else 
            {
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
        return false;
      })
    });
  </script>


</body>

</html>