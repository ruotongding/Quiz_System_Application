<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QUIZ</title>
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

		<h1>QUIZ</h1>



	<?php
    createTableQuiz();

  try
{
  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');


  $sql = "select * from Quiz";

  $res = $pdo->query($sql);
  while($row = $res->fetch(PDO::FETCH_ASSOC))
  {
    $quiz_name = $row['quiz_name'];
    echo "<td>$quiz_name</td><br>";
    echo(showUptateButton($quiz_name));
    echo(showDeleteButton($quiz_name));

  }
  // print_r("Wrong username or password");
}
catch(PDOException $e)
{
  echo 'fail to connect database'.$e->getMessage();
}


	?>


	</div>

  <div style = "text-align:center;">
    <a href="http://127.0.0.1:99/cw2/createquiz.php">
      <button>Create Quiz</button>
    </a>
  </div>

</body>
</html>

<?php
function showDeleteButton($quizname)
{
  return "

      <a href = 'quizdelete.php?quizname=$quizname'> delete this quiz </a>
    </br>
  ";
}

function showUptateButton($quizname)
{
  return "

      <a href = 'quizupdate.php?quizname=$quizname'> update this quiz </a>
    </br>
  ";
}


function createTableQuiz()
{
  $sql = "
     CREATE TABLE IF NOT EXISTS Quiz
     (
       quiz_id int primary key auto_increment,
       quiz_name varchar(50) not null unique,
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

function showRegisterForm()
{
	return '


	<form method="POST">



    <label class="form-label"  for="name">username</label>
		<input class="form-control"  type="text" name="username">

		<label class="form-label"  for="name">Password</label>
		<input class="form-control"  type="password" name="password">




		<input type="submit" value="Login">


	</form>



	';

}
 ?>
