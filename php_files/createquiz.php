<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Quiz</title>
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

		<h1>Create Quiz</h1>



    <?php
      if(empty($_POST))
      {
        echo(showCreateForm());
      }
      else
      {
        $username = $_POST['username'];
        $staff_id = 0;
        createTable();

        try
        {
          $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');

          $sql = "select * from Staff where username = '$username'";

          $res = $pdo->query($sql);
          while($row = $res->fetch(PDO::FETCH_ASSOC))
          {

            // header('location:http://127.0.0.1:99/cw2/quiz.php');

            $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            $quiz_name = $_POST['quizname'];
            $staff_id = $row['staff_id'];
            $quiz_available = $_POST['quizavailable'];
            $quizmark = $_POST['fullmark'];
            $quiz_duration = $_POST['quizduration'];
            $sql = "INSERT INTO Quiz (quiz_name, quiz_available, quiz_duration, fullmark, author_id)
                    VALUES ('$quiz_name', '$quiz_available', '$quiz_duration', '$quizmark', '$staff_id')";
            $pdo->query($sql);
            header('location:http://127.0.0.1:99/cw2/createquestion.php');
          }
          echo '<script>alert("You are not alowed to create a quiz")</script>';
          echo(showCreateForm());
        }
        catch(PDOException $e)
        {
          echo 'fail to connect database'.$e->getMessage();
        }
      }


        // if($islogin = 1)
        // {
        //   header('location:http://127.0.0.1:99/cw2/quiz.php');
        // }



    	?>






	</div>
</body>
</html>


<?php
//create Student table
function createTable()
{
  $sql = "
     CREATE TABLE IF NOT EXISTS Quiz
     (
       quiz_id int primary key auto_increment,
       quiz_name varchar(50) unique not null,
       quiz_available varchar(10) not null,
       quiz_duration varchar(20) not null,
       fullmark int,
       author_id int not null,
       foreign key (author_id) references Staff(staff_id)
          ON DELETE RESTRICT

     )
  ";

 $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');

 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

 $pdo->query($sql);


}

//createdatabase
function createDatabase()
{
  $sql = "CREATE DATABASE IF NOT EXISTS quizsystem";

  $pdo = new pdo('mysql:localhost', 'root', 'drt789mju');

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

  $pdo->query($sql);

}







function showCreateForm()
{
	return '


	<form method="POST">

		<label class="form-label" for="name">your username</label>
		<input class="form-control" type="text" name="username">

		<label class="form-label"  for="name">quiz name</label>
		<input class="form-control"  type="text" name="quizname">

    <label class="form-label"  for="name">quiz available</label>
		<input class="form-control"  type="text" name="quizavailable">

		<label class="form-label"  for="name">Quiz duration</label>
		<input class="form-control"  type="text" name="quizduration">

		<label class="form-label"  for="name">quiz mark</label>
		<input class="form-control"  type="number" name="fullmark">


		<input type="submit" value="Create">

	</form>



	';

}





?>
