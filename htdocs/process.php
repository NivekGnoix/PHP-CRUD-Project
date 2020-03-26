<?php

session_start();
$mysqli = new mysqli('localhost', 'root', 'walkthewalk', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$name = '';
$email = '';
$update = false;

if (isset($_POST['save']))
{
  $name = $_POST['name'];
  $email = $_POST['email'];

  $mysqli->query("INSERT INTO data (name, email) VALUES('$name', '$email')")
  or die($mysqli->error);

  $_SESSION['message'] = "The record has been saved!";
  $_SESSION['msg_type'] = "success";

  header("location: index.php");

}
//
if (isset($_GET['delete']))
{
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM data where id=$id") or die($mysqli->error());

  $_SESSION['message'] = "The record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location: index.php");

}

if (isset($_GET['edit']))
{
  $id = $_GET['edit'];
  $update = true;
  $result = $mysqli->query("SELECT * FROM data where id=$id") or die($mysqli->error());
  if (@count($result)==1)
  {
    $row = $result->fetch_array();
    $name = $row['name'];
    $email = $row['email'];
  }
}

if (isset($_POST['update']))
{
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];

  $mysqli->query("UPDATE data SET name='$name', email='$email' WHERE id=$id") or die($mysqli->error);


  $_SESSION['message'] = "The record has been updated!";
  $_SESSION['msg_type'] = "warning";

  header('location: index.php');

}
