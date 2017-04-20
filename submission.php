<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<h1 align="center"> Congratulations! Your work has been submitted </h1>

<p>

<?php
  #Set up database
  class MyDB extends SQLite3
  {
    function __construct()
    {
      $this->open($_SERVER['DOCUMENT_ROOT'].'/local.db');
    }
  }
  $db = new MyDB();
  if(!$db) { echo $db->lastErrorMsg(); }
  $db->query("CREATE TABLE IF NOT EXISTS DATA565 (
    id integer PRIMARY KEY,
    input_text varchar,
    input_time varchar
  )");
  $ret = $db->query("SELECT max(id) FROM DATA565");
  $maxid = $ret->fetchArray()[0]+1;
  // echo $maxid;
  $thedate = date('Y-m-d G:i:s');
  echo $thedate;
  $db->query("INSERT INTO DATA565 VALUES(".$maxid.",'".$_POST["name"]."','".$thedate."')");
?>

</p>

</body>

</html>
