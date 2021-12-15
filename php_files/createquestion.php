<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Question</title>
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

		<h1>Create Question</h1>


    <?php
       if(empty($_POST))
       {
         echo(showCreateForm());
       }
       else
       {
         createTableQuestions();
         createTableOptions();
         $quizname = $_POST['quizname'];
         $staff_id = 0;


         try
         {
           $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');

           $sql = "select * from Quiz where quiz_name = '$quizname'";

           $res = $pdo->query($sql);
           while($row = $res->fetch(PDO::FETCH_ASSOC))
           {
             // print_r("test1");
             // header('location:http://127.0.0.1:99/cw2/quiz.php');

             $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

             $quiz_id = $row['quiz_id'];
             $question_desc = $_POST['question1'];
             $questionmark = $_POST['question1mark'];
             $sql = "INSERT INTO Questions (question_id, quiz_id, question_desc, question_mark)
                     VALUES (1,'$quiz_id', '$question_desc', '$questionmark')";

             $pdo->query($sql);

             //insert options for question 1
             $option_desc11 = $_POST['option11'];
             $correct11 = $_POST['correct11'];
             $sql = "INSERT INTO Options(option_id,quiz_id, question_id, option_desc,correct_ans)
                     VALUES (1,'$quiz_id', 1, '$option_desc11','$correct11')";

             $pdo->query($sql);
             //insert options for question 1
             $option_desc12 = $_POST['option12'];
             $correct12 = $_POST['correct12'];
             $sql = "INSERT INTO Options(option_id,quiz_id, question_id, option_desc,correct_ans)
                     VALUES (2,'$quiz_id', 1, '$option_desc12','$correct12')";

             $pdo->query($sql);



             //insert question 2
             $question_desc2 = $_POST['question2'];
             $questionmark2 = $_POST['question2mark'];
             $sql = "INSERT INTO Questions (question_id, quiz_id, question_desc, question_mark)
                     VALUES (2,'$quiz_id', '$question_desc2', '$questionmark2')";

             $pdo->query($sql);

             //insert options for question 2
             $option_desc21 = $_POST['option21'];
             $correct21 = $_POST['correct21'];
             $sql = "INSERT INTO Options(option_id,quiz_id, question_id, option_desc,correct_ans)
                     VALUES (1,'$quiz_id', 2, '$option_desc21','$correct21')";

             $pdo->query($sql);
             //insert options for question 2
             $option_desc22 = $_POST['option22'];
             $correct22 = $_POST['correct22'];
             $sql = "INSERT INTO Options(option_id,quiz_id, question_id, option_desc,correct_ans)
                     VALUES (2,'$quiz_id', 2, '$option_desc22','$correct22')";

             $pdo->query($sql);

             //insert question 3
             $question_desc3 = $_POST['question3'];
             $questionmark3 = $_POST['question3mark'];
             $sql = "INSERT INTO Questions (question_id, quiz_id, question_desc, question_mark)
                     VALUES (3, '$quiz_id', '$question_desc3', '$questionmark3')";

             $pdo->query($sql);

             //insert options for question 3
             $option_desc31 = $_POST['option31'];
             $correct31 = $_POST['correct31'];
             $sql = "INSERT INTO Options(option_id,quiz_id, question_id, option_desc,correct_ans)
                     VALUES (1,'$quiz_id', 3, '$option_desc31','$correct31')";

             $pdo->query($sql);
             //insert options for question 3
             $option_desc32 = $_POST['option32'];
             $correct32 = $_POST['correct32'];
             $sql = "INSERT INTO Options(option_id,quiz_id, question_id, option_desc,correct_ans)
                     VALUES (2,'$quiz_id', 3, '$option_desc32','$correct32')";

             $pdo->query($sql);
             //header('location:http://127.0.0.1:99/cw2/createoption.php');
           }
           header('location:http://127.0.0.1:99/cw2/quizstaff.php');
           //print_r("you are not allowed to create a quiz");
         }
         catch(PDOException $e)
         {
           echo 'fail to connect database'.$e->getMessage();
         }
       }





    	?>






	</div>
</body>
</html>


<?php
//create Student table
function insertInTable($question_desc,$questionmark)
{
  $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

  $quiz_id = $row['quiz_id'];
  $question_desc = $_POST['question1'];
  $questionmark = $_POST['question1mark'];
  $sql = "INSERT INTO Questions (quiz_id, question_desc, question_mark)
          VALUES ('$quiz_id', '$question_desc', '$questionmark')";
  $pdo->query($sql);
}


function createTableOptions()
{
  $sql = "
     CREATE TABLE IF NOT EXISTS Options
     (
       option_id int,
       quiz_id int not null,
       question_id int not null,
       option_desc varchar(70) not null,
       correct_ans varchar(10) not null,
       primary key(option_id, quiz_id,question_id),
       foreign key (quiz_id) references Quiz(quiz_id) ON DELETE RESTRICT


     )
  ";

 $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
 $pdo->query($sql);
}

function createTableQuestions()
{
  $sql = "
     CREATE TABLE IF NOT EXISTS Questions
     (
       question_id int not null,
       quiz_id int not null,
       question_desc varchar(70) not null,
       question_mark int,
       primary key(question_id,quiz_id),
       foreign key (quiz_id) references Quiz(quiz_id)
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

    <label class="form-label" for="name">please enter the quiz name</label>
    <input class="form-control" type="text" name="quizname">

		<label class="form-label" for="name">question 1</label>
		<input class="form-control" type="text" name="question1">
    <label class="form-label" for="name">question1 mark</label>
		<input class="form-control" type="number" name="question1mark">


    <label class="form-label" for="name">Q1 option1</label>
    <input class="form-control" type="text" name="option11">
		<label class="form-label" for="name">is it correct?</label>
		<input class="form-control" type="text" name="correct11">

    <label class="form-label" for="name">Q1 option2</label>
    <input class="form-control" type="text" name="option12">
		<label class="form-label" for="name">is it correct?</label>
		<input class="form-control" type="text" name="correct12">


    <label class="form-label" for="name">question 2</label>
  	<input class="form-control" type="text" name="question2">
    <label class="form-label" for="name">question2 mark</label>
		<input class="form-control" type="number" name="question2mark">

    <label class="form-label" for="name">Q2 option1</label>
    <input class="form-control" type="text" name="option21">
		<label class="form-label" for="name">is it correct?</label>
		<input class="form-control" type="text" name="correct21">

    <label class="form-label" for="name">Q2 option2</label>
    <input class="form-control" type="text" name="option22">
		<label class="form-label" for="name">is it correct?</label>
		<input class="form-control" type="text" name="correct22">

    <label class="form-label"  for="name">question3</label>
		<input class="form-control"  type="text" name="question3">

    <label class="form-label" for="name">question3 mark</label>
		<input class="form-control" type="number" name="question3mark">

    <label class="form-label" for="name">Q3 option1</label>
    <input class="form-control" type="text" name="option31">
		<label class="form-label" for="name">is it correct?</label>
		<input class="form-control" type="text" name="correct31">

    <label class="form-label" for="name">Q3 option2</label>
    <input class="form-control" type="text" name="option32">
		<label class="form-label" for="name">is it correct?</label>
		<input class="form-control" type="text" name="correct32">




		<input type="submit" value="Create">

	</form>



	';

}


?>
