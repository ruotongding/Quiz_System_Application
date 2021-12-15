<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>uptate quiz info</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<style type="text/css">
		#wrapper
		{
			margin: auto;
			width: 25em;
		}
	</style>

</head>
<body>
	<div id="wrapper">

		<h1>fill in the new quiz info</h1>




	<?php

    if(empty($_POST))
    {
      echo(showUptateForm());
    }
    else
    {
      update($_GET['quizname']);

      header('location:http://127.0.0.1:99/cw2/quizstaff.php');
    }



    // try
    // {
    //   $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
    //
    //   $sql = "select * from Student where username = '$username' and password = '$password'";
    //
    //   $res = $pdo->query($sql);
    //   while($row = $res->fetch(PDO::FETCH_ASSOC))
    //   {
    //     print_r($row);
    //     header('location:http://127.0.0.1:99/cw2/quiz.php');
    //
    //   }
    //   print_r("Wrong username or password");
    // }
    // catch(PDOException $e)
    // {
    //   echo 'fail to connect database'.$e->getMessage();
    // }
    // if($islogin = 1)
    // {
    //   header('location:http://127.0.0.1:99/cw2/quiz.php');
    // }



	?>


	</div>
</body>
</html>

<?php




function update($quizname)
{
  $newname = $_POST['newquizname'];
  $newavailable = $_POST['newavailable'];
  $newduration = $_POST['newduration'];
  $sql = "
     update quiz
     set quiz_name = '$newname',quiz_available = '$newavailable',quiz_duration = '$newduration'
     where quiz_name = '$quizname'
  ";

 $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
 $pdo->query($sql);
}

function showUptateForm()
{
	return '


	<form method="POST">



    <label class="form-label"  for="name">new quiz name</label>
		<input class="form-control"  type="text" name="newquizname">

		<label class="form-label"  for="name">quiz available</label>
		<input class="form-control"  type="text" name="newavailable">

    <label class="form-label"  for="name">quiz duration</label>
		<input class="form-control"  type="text" name="newduration">



		<input type="submit" value="Update">


	</form>



	';

}
 ?>
