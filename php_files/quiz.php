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

    <!-- <table style = 'text-align:left;' border = '1'>

    </table> -->


	<?php


  try
{
  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');


  $sql = "select * from Quiz";

  $res = $pdo->query($sql);
  echo("<table border=1>");
  echo("<tr>");
  echo "<td>quiz name</td>";
  echo "<td>available</td>";
  echo "<td>quiz link</td>";
  echo "<td>mark if taken</td>";
  echo("</tr>");
  while($row = $res->fetch(PDO::FETCH_ASSOC))
  {
    $quiz_id = $row['quiz_id'];
    $quiz_name = $row['quiz_name'];
    $quiz_available = $row['quiz_available'];
    $student_username = $_GET['username'];
    echo("<tr>");
    echo "<td>$quiz_name</td>";
    echo "<td>$quiz_available</td>";
    if($row['quiz_available']=='yes')
    {
      echo("<td>");
      echo(showDoQuizButton($quiz_name,$student_username));
      echo("</td>");
    }
    else
    {
      echo "<td>not avaliable</td>";
    }
    $takenmark = getTakenMark($quiz_id,$student_username);
    if($takenmark==-1)
    {
      echo "<td>not taken</td>";
    }
    else
    {
      echo("<td>");
      echo($takenmark);
      echo("</td>");
    }

    // echo("<td>showDoQuizButton($quiz_name)<td>");
    echo("</tr>");


  }
  echo("</table>");
  // print_r("Wrong username or password");
}
catch(PDOException $e)
{
  echo 'fail to connect database'.$e->getMessage();
}
    // echo(showRegisterForm());
    // $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
    //
    // $sql = mysql_query("select * from Quiz");
    // //$res = $pdo->query($sql);
    // $datarow = mysqli_num_rows($sql);
    // for($i=0;$i<$datarow;$i++)
    // {
    //   $sql_arr = mysql_fetch_assoc($sql);
    //   $quiz_name = $res['quiz_name'];
    //   echo "<td>$id</td>";
    // }


// echo(showQuizbuttuon());
	?>


	</div>
</body>
</html>


<?php
function getTakenMark($quiz_id,$username)
{
  $sql = "
    select fullmark from taken where quiz_id = '$quiz_id' and student_username = '$username'
  ";

  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $res = $pdo->query($sql);
  $mark = -1;
  while($row = $res->fetch(PDO::FETCH_ASSOC))
  {
    $mark = $row['fullmark'];
  }
  return $mark;
}

function showDoQuizButton($quizname,$username)
{

  return "
      <a href = 'quiztake.php?quizname=$quizname&username=$username'> do this quiz </a>
    </br>
  ";
}

function showQuizbuttuon()
{
	return '


	<form method="POST">



    <a href="http://127.0.0.1:99/cw2/mysqlquiz.php">DO SQL</a>
    <a href="http://127.0.0.1:99/cw2/pythonquiz.php">DO PYTHON</a>


	</form>



	';

}
 ?>
