<?php
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
      <div class="col s12 m6">
        <div class="card">
          <div class="card-image">
            <img src="../<?php echo ($data['photo_path']); ?>">
            <span class="card-title">
              <?php echo (ucfirst($data['username'])); ?>
              <a class="btn 80cbc4 teal lighten-3 btnEdit blue-grey lighten-4 black-text" href="indexphotoEdit.php">編輯</a>
            </span>
          </div>
          <div class="card-content">
            <p class="text">
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
          <?php echo ($student['content']) ?>
          <!-- <a class="btn 80cbc4 teal lighten-3 btnEdit" href="studentEdit.php">編輯</a> -->
          <button id='studentCon' class="btn waves-effect waves-light blue-grey lighten-4 black-text btnEdit">編輯</button>
          <!-- <span id='studentCon' type='button' class="edit">編輯</span> -->
        </p>

        <?php foreach ($student_skills as $StudentSkill) : ?>
        <a class="waves-effect waves-light btn"> <?php echo ($StudentSkill['skill_name']) ?> </a>
        <?php endforeach ?>
        <!-- <a href="" type='button'>編輯</a> -->
        <!-- <span id='studentSkill' type='button' class="edit">編輯</span> -->
        <button id='studentSkill' class="btn waves-effect waves-light blue-grey lighten-4 black-text btnEdit">編輯</button>

        <hr>
        <p class="text">
          <?php echo ($work['content']) ?>
          <button id='workerCon' class="btn waves-effect waves-light blue-grey lighten-4 black-text btnEdit">編輯</button>
          <br>
        </p>
        <?php foreach ($work_skills as $WorkSkill) : ?>
        <a class="waves-effect waves-light btn"> <?php echo ($WorkSkill['skill_name']) ?> </a>
        <?php endforeach ?>
        <button id='workerSkill' class="btn waves-effect waves-light blue-grey lighten-4 black-text btnEdit">編輯</button>
      </div>
  </main>


  <?php include_once "footer.php" ?>



  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();

      $('#studentSkill').on('click',function(){
        window.location.href = "studentSkill.php"
      })

      $('#studentCon').on('click',function(){
        window.location.href = "studentCon.php"
      })

      $('#workerSkill').on('click',function(){
        window.location.href = "workerSkill.php"
      })

      $('#workerCon').on('click',function(){
        window.location.href = "workerCon.php"
      })
    });
  </script>


</body>

</html>