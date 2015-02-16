
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add a Cartoon</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <script src="js/jquery.js"></script>
</head>

<body>
    
<?php include("template/nav.php");

$delimiter = '|';

  if(isset($_POST['submit'])){

    $file = fopen("data.txt", "a+");      

    if (!$file) {
      die("There was a problem opening the data file");
    }

    $title = $_POST['title'];
    $channel = $_POST['channel'];

    fputs($file, "$title$delimiter$channel\n");

    fclose($file);
  }

?>

<div id="wrapper">

<div>
    <p>Your entry has been added!</p>
</div>

</div>
</body>
</html>