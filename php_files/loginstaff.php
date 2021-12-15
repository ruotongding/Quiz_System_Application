<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Staff Login</title>
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

		<h1>Staff Login</h1>




	<?php
		if(empty($_POST))
		{
			echo(showLoginForm());
		}

		else
		{
			$username = $_POST['username'];
	    $password = $_POST['password'];


	    try
	    {
	      $pdo = new pdo('mysql:host=localhost;dbname=quizsystem', 'root', 'drt789mju');

	      $sql = "select * from Staff where username = '$username' and password = '$password'";

	      $res = $pdo->query($sql);
				$find = 0;
	      while($row = $res->fetch(PDO::FETCH_ASSOC))
	      {
	        // print_r($row);
	        // header('location:http://127.0.0.1:99/cw2/quizstaff.php');
					$find = 1;
	      }
				if($find==1)
				{
					echo "
					<br>
					<a href='quizstaff.php?username=$username'>
						<button>View and Edit Quiz</button>
					</a>
					";
				}
				else
				{
					echo '<script>alert("Wrong password or username")</script>';
					echo(showLoginForm());
				}
				// echo '<script>alert("Wrong password or username")</script>';
			 	// echo(showLoginForm());
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
function showLoginForm()
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
