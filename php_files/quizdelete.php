<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>delete quiz info</title>
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

		<h1>fill in the delete info</h1>


	<?php

    createTriggerTable();
    // createTrigger();

    if(empty($_POST))
    {
      echo(showDeleteForm());
    }
    else
    {
      deleteTaken($_GET['quizname']);
      deleteOptions($_GET['quizname']);
      deleteQuestions($_GET['quizname']);
      deleteQuiz($_GET['quizname']);


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

// function createTrigger()
// {
//   $sql = "
//
//   CREATE TRIGGER record_quiz_deletion
//       BEFORE DELETE ON quiz FOR EACH ROW
//       BEGIN
//         INSERT INTO delete_record
//           SET staff_id = OLD.author_id,
//               quiz_id = OLD.quiz_id,
//               deletedate = NOW();
//       END
//
//
//   ";
//
//   $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//   $pdo->query($sql);
// }

function createTriggerTable()
{

  $sql = "
     CREATE TABLE IF NOT EXISTS delete_record
     (
       staff_id int,
       quiz_id int,
       deletedate date
     )
  ";

 $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');

 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

 $pdo->query($sql);


}


function deleteTaken($quizname)
{

  $sql = "
    delete from taken where quiz_id in(select quiz_id from quiz where quiz_name = '$quizname')
  ";

  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $pdo->query($sql);

}

function deleteOptions($quizname)
{

  $sql = "
    delete from options where quiz_id in(select quiz_id from quiz where quiz_name = '$quizname')
  ";

  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $pdo->query($sql);

}

function deleteQuestions($quizname)
{

  $sql = "
    delete from questions where quiz_id in(select quiz_id from quiz where quiz_name = '$quizname')
  ";

  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $pdo->query($sql);

}

function deleteQuiz($quizname)
{

  $sql = "
    delete from Quiz where quiz_name = '$quizname'
  ";

  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $pdo->query($sql);

}

function showDeleteForm()
{
	return '


	<form method="POST">



    <label class="form-label"  for="name">quiz name you want to delete</label>
		<input class="form-control"  type="text" name="deletequizname">

		<label class="form-label"  for="name">brief reason to delete</label>
		<input class="form-control"  type="text" name="reason">





		<input type="submit" value="Delete">


	</form>



	';

}
 ?>
