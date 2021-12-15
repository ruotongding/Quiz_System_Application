<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Do Quiz</title>
</head>
<body>
	<h1>Do Quiz</h1>
	<?php


    $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');

    // $sql = "select * from Student where username = '$username' and password = '$password'";

    $getquizname = $_GET['quizname'];
    $sql = "select * from questions where quiz_id in
            (select quiz_id from quiz where quiz_name = '$getquizname')";

    $res = $pdo->query($sql);
    //$rowtest = $res->fetch(PDO::FETCH_ASSOC);
    print_r($_GET['quizname']);
    echo("<br>");
    echo("<br>");
    //print questions
    while($row = $res->fetch(PDO::FETCH_ASSOC))
    {
      echo("<tr>");
      echo("<td>" . $row['question_desc'] . "</td><br>");
      $question_id = $row['question_id'];
      //print options
      $sql = "select * from options where quiz_id in(select quiz_id from quiz where quiz_name = '$getquizname') and question_id = '$question_id'";
      $res1 = $pdo->query($sql);
      while($row1 = $res1->fetch(PDO::FETCH_ASSOC))
      {
        echo("<tr>");
        echo("<td>" . $row1['option_desc'] . "</td><br>");
        echo("</tr>");
      }
      echo("</tr>");
    }
    // while($row = $records->fetch())
    // {
    //   echo("<tr>");
    //   echo("<td>" . $row['question_desc'] . "</td>");
    //
    //   echo("</tr>");
    // }
    // echo("</table>");
    echo(showAnswerForm());
    echo(showQuizButton());
    if(!empty($_POST))
    {
      $ans1 = $_POST['q1answer'];
      $ans2 = $_POST['q2answer'];
      $ans3 = $_POST['q3answer'];

      $mark = 0;
      $sql = "select * from options where question_id=1 and correct_ans='yes' and quiz_id in (select quiz_id from quiz where quiz_name = '$getquizname')";

      $res = $pdo->query($sql);
      $correct1 = $res->fetch(PDO::FETCH_ASSOC);

      if($ans1 == $correct1['option_desc'])
      {
        $sql = "select * from questions where quiz_id in
              (select quiz_id from quiz where quiz_name = '$getquizname') and question_id = 1";
        $res = $pdo->query($sql);
        $addmark = $res->fetch(PDO::FETCH_ASSOC);
        $mark += $addmark['question_mark'];
        //print_r($mark);
      }
      //check for question2
      $sql = "select * from options where question_id=2 and correct_ans='yes' and quiz_id in (select quiz_id from quiz where quiz_name = '$getquizname')";

      $res = $pdo->query($sql);
      $correct2 = $res->fetch(PDO::FETCH_ASSOC);

      if($ans2 == $correct2['option_desc'])
      {
        $sql = "select * from questions where quiz_id in
              (select quiz_id from quiz where quiz_name = '$getquizname') and question_id = 2";
        $res = $pdo->query($sql);
        $addmark = $res->fetch(PDO::FETCH_ASSOC);
        $mark += $addmark['question_mark'];
        //print_r($mark);
      }
      //check for question3
      $sql = "select * from options where question_id=3 and correct_ans='yes' and quiz_id in (select quiz_id from quiz where quiz_name = '$getquizname')";

      $res = $pdo->query($sql);
      $correct3 = $res->fetch(PDO::FETCH_ASSOC);

      if($ans3 == $correct3['option_desc'])
      {
        $sql = "select * from questions where quiz_id in
              (select quiz_id from quiz where quiz_name = '$getquizname') and question_id = 3";
        $res = $pdo->query($sql);
        $addmark = $res->fetch(PDO::FETCH_ASSOC);
        $mark += $addmark['question_mark'];

      }
      print_r("you get a mark: ");
      print_r($mark);

      createTableTaken();
      //insert the record into table Taken
      $sql = "select quiz_id from quiz where quiz_name = '$getquizname'";
      $res = $pdo->query($sql);
      $quiztoinsert = $res->fetch(PDO::FETCH_ASSOC);
      $quiz_id = $quiztoinsert['quiz_id'];
      $student_username = $_POST['username'];
      $sql = "INSERT INTO Taken (quiz_id, student_username, attempt_date, fullmark)
              VALUES ('$quiz_id', '$student_username', '2021-11-29', '$mark')";
      $pdo->query($sql);
    }

	?>



</body>
</html>


<?php
function showQuizButton()
{
  $username = $_GET['username'];
  return "

      <a href = 'quiz.php?username=$username'> go back to quiz list </a>
    </br>
  ";
}

function createTableTaken()
{
  $sql = "
     CREATE TABLE IF NOT EXISTS Taken
     (
       quiz_id int not null,
       student_username varchar(30) not null,
       attempt_date date not null,
       fullmark int,
       primary key (quiz_id, student_username),
       foreign key (quiz_id) references Quiz(quiz_id) ON DELETE RESTRICT,
       foreign key (student_username) references Student(username) ON DELETE RESTRICT
     )
  ";

 $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');

 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

 $pdo->query($sql);


}


function showAnswerForm()
{
	return '


	<form method="POST">



    <label class="form-label"  for="name">your username</label>
		<input class="form-control"  type="text" name="username">
    <br>
		<label class="form-label"  for="name">Question1 Answer</label>
		<input class="form-control"  type="text" name="q1answer">
    <br>
    <label class="form-label"  for="name">Question2 Answer</label>
		<input class="form-control"  type="text" name="q2answer">
    <br>
    <label class="form-label"  for="name">Question3 Answer</label>
		<input class="form-control"  type="text" name="q3answer">


    <br>
		<input type="submit" value="submit">


	</form>



	';

}
 ?>
