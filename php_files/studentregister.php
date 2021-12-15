<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Register</title>
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

		<h1>Student Register</h1>




	<?php
	//showPOSTdata();
  createDatabase();
  createTable();

	if(empty($_POST))
	{
		echo(showRegisterForm());
	}
	else
	{
		$user = getUserCredentials();

		if(isset($user['badinput']))
		{
			echo ("something went wrong: " .$user['badinput'] );
			echo(showRegisterForm());
		}
		else{
      addUserToDatabase($user);
      $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

      $forename = $_POST['forename'];
      $surname = $_POST['surname'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql = "INSERT INTO Student (username, forename, surname, password)
              VALUES ('$username', '$forename', '$surname', '$password')";
      $pdo->query($sql);
			header('location:http://127.0.0.1:99/cw2/loginstudent.php');
    }



	}




	// print_r($_POST);
	?>


	</div>
</body>
</html>


<?php
//create Student table
function createTable()
{
  $sql = "
     CREATE TABLE IF NOT EXISTS Student
     (
       student_id int primary key auto_increment,
       username varchar(30) not null unique,
       forename varchar(30) not null,
       surname varchar(30) not null,
       password varchar(30) not null

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

function addUserToDatabase($user)
{
  print_r($user);
  $name = $user['forename'];
  echo("Ready to add $name to database");
}


function showPOSTdata()
{
	foreach ($_POST as $key => $value)
	{
		echo("<br>Inside $key is value: $value");
	}
}


function showRegisterForm()
{
	return '


	<form method="POST">

		<label class="form-label" for="name">forename</label>
		<input class="form-control" type="text" name="forename">

		<label class="form-label"  for="name">surname</label>
		<input class="form-control"  type="text" name="surname">

    <label class="form-label"  for="name">username</label>
		<input class="form-control"  type="text" name="username">

		<label class="form-label"  for="name">Password</label>
		<input class="form-control"  type="password" name="password">

		<label class="form-label"  for="cname">Confirm Password</label>
		<input class="form-control"  type="password" name="cpassword">


		<input type="submit" value="Register">
    <a href="http://127.0.0.1:99/cw2/loginstudent.php">Just Login</a>

	</form>



	';

}

function getUserCredentials()
{
	$user = array();
	if ($_POST['password'] != $_POST['cpassword'])
	{
		$user['badinput'] = "Passwords don't match";
		return $user;
	}


	$user['forename'] = $_POST['forename'];
	$user['username'] = $_POST['username'];
	$user['password'] = $_POST['password'];

	return $user;
}



?>
