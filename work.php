<?php
require_once "php/db.php";
require_once "php/function.php";
$images=get_images();
// print_r($images);
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
<a href=""></a>

  <main>

  <div class="work_list collection container">
    <a href="#!" class="collection-item"><span class="badge">1</span>Alan</a>
    <a href="#!" class="collection-item"><span class="new badge">4</span>Alan</a>
    <a href="#!" class="collection-item">Alan</a>
    <a href="#!" class="collection-item"><span class="badge">14</span>Alan</a>
  </div>
            
  <div class="fixed-action-btn">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">mode_edit</i>
  </a>

  <ul>
    <li><a class="btn-floating red" href="https//gmail.com"><i class="material-icons">insert_chart</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  </ul>
</div>
  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
      $('.carousel').carousel({
              
      });
      $('.fixed-action-btn').floatingActionButton();
    });
  </script>


</body>

</html>