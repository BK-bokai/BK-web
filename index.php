<?php
require_once "php/db.php";
require_once "php/function.php";
$data=get_index_photo();
$student=get_student();
$student_skills=get_student_skills();
$work=get_work();
$work_skills=get_work_skills();
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
    <div class="row container">
      <div class="col s12 m6">
        <div class="card">
          <div class="card-image">
            <img src="<?php echo ($data['photo_path']); ?>">
            <span class="card-title"> <?php echo (ucfirst($data['username'])); ?> </span>
          </div>
          <div class="card-content">
            <p class="text" >    
            <?php echo ($data['content_one']); ?>
            </p>
            <p class="text">
            <?php echo ($data['content_two']); ?>
            </p>
          </div>
        </div>
      </div>

      <div class="intro col s12 m6">
        <p class="text">
          <?php echo ($student['content'])?>
        </p>
        <?php foreach ($student_skills as $StudentSkill) :?>
        <a class="waves-effect waves-light btn"> <?php echo ($StudentSkill['skill_name'])?> </a>
        <?php endforeach?>
        <hr>
        <p class="text">
          <?php echo ($work['content'])?>
          <br>
        </p>
        <?php foreach ($work_skills as $WorkSkill) :?>
        <a class="waves-effect waves-light btn"> <?php echo ($WorkSkill['skill_name'])?> </a>
        <?php endforeach?>
      </div>
  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
    });
  </script>


</body>

</html>