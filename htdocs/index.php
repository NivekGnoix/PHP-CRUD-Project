<!DOCTYPE html>
<html>
	<head>
		<title>PHP CRUD</title>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php require_once 'process.php';?>

		<?php
		if (isset($_SESSION['message'])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">

			<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);
			?>
		</div>
		<?php endif ?>
		<div class="container">

		<?php
			$mysqli = new mysqli('localhost', 'root', 'walkthewalk', 'crud') or die(mysqli_error($mysqli));
			$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
			//pre_r($result); this line of code displays the mysqli_result object of the whole database ex: num rows=2, field count=3
		?>

			<div class="row justify-content-center">
				<table class="table">
				<thead>
					<tr>
						<th>Name</th>
							<th>E-mail</th>
								<th colspan="2">Action</th>
					</tr>
				</thead>
				<?php
				while ($row = $result->fetch_assoc()):
				?>
				<tr>
					<td> <?php echo $row['name']; ?></td>
					<td> <?php echo $row['email']; ?></td>
					<td>
						<a href="index.php?edit=<?php echo $row['id']; ?>"
							class="btn btn-info">Edit</a>
						<a href="process.php?delete=<?php echo $row['id']; ?>"
							class="btn btn-danger">Delete</a>
					</td>
				</tr>
			<?php endwhile;
			?>
			</table>
			</div>

			<?php
			//function that displays an array of each data id=1 , name=john menards, email=example@hotmail.com
			function pre_r( $array )
			{
				echo '<pre>';
				print_r($array);
				echo '</pre>';
			}
			?>

		<div class="row justify-content-center">
		<form action="process.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<div class="form-group">
			<label>Name</label>
			<input type ="text" name ="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your Full Name">
			</div>
			<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter your Email">
			</div>
			<div class="form-group">

			<?php
			if ($update == true):
			?>

				<button type="submit" class="btn btn-primary" name="update">Update</button>
			<?php else: ?>
			<button type="submit" class="btn btn-primary" name="save">Save</button>
		<?php endif; ?>
			</div>
		</form>
	</div>
</div>
	</body>
