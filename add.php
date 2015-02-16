<!doctype html>


<?php $delimiter = '|';
$result = "";
$item = "";

function exists($title, $fn){
    $txt_file = file_get_contents($fn);
    if (!$txt_file) {
        die("There was a problem opening the data file");
    }
    $rows = explode("\n", $txt_file);
    foreach($rows as $row => $data){
        $row_data = explode('|', $data);
        $this_title = $row_data[0];
        if (strtolower($title) == strtolower($this_title)){
            return true;
        }
    }
    return false;


}


if(isset($_POST['submit'])){

    $file = fopen("data.txt", "a+");

    if (!$file) {
      die("There was a problem opening the data file");
    }

    $title = "";
    $channel = "";
    $year = "";
    $airing = "";
    $year_regex = '/^[0-9]{4}$/';
        if (isset($_POST['title'])){ $title = htmlspecialchars(trim($_POST['title'])); };
        if (isset($_POST['channel'])){ $channel = $_POST['channel']; };
        if (isset($_POST['year'])){ $year = $_POST['year']; };
        if (isset($_POST['airing'])){ $airing = $_POST['airing']; };
    
    if (empty($title) || empty($channel) || empty($year) || empty($airing)){
        $result = "<p class='error_msg'>Please go back and fill out all fields.</p>";
    }else if (!preg_match($year_regex, $year)){
        $result = "<p class='error_msg'>Please enter a valid year.</p>";
    }else if (exists($title, 'data.txt')) {
        $result = "<p class='error_msg'>You entry already exists!</p>";
    }else{
        $result = "<p class='success_msg'>Your submission was successful!</p>";
        $item = '<span class="label">Title: </span>' . $title . '<br><span class="label">Channel: </span>' . $channel . '<br><span class="label">First aired: </span>' . $year . '<br><span class="label">Still airing: </span>' . $airing;

        fputs($file, "\n$title$delimiter$channel$delimiter$year$delimiter$airing");
    }
    
    fclose($file);
  }

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add a Cartoon</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <script src="js/jquery.js"></script>
    <script src="js/valid.js"></script>
    <script type="text/javascript">
        function validate() {
            var year = validYearAdd(document.forms.add_form.year.value);
            if (!year) {
                    msg("submit_msg","   Please correct errors in form before submitting");
                    return false;
            } else {
                    return true;
            }
        }
    </script>
</head>

<body>
    
<?php include("template/nav.php"); ?>

<div id="wrapper">
    <?php include('template/header.php'); ?>
<div id="form_container">
    <h2>Add a Cartoon</h2>
    <div id="result">
    <?php echo($result); ?>
</div>
<div id="submission">
    <?php echo($item); ?>
</div>
<form name="add_form" action="add.php" method="post" onSubmit="return validate();">
    <p>Title: <input type="text" name="title" required></p>
    <p>Channel:
        <select name="channel">
            <option value="Nickelodeon">Nickelodeon</option>
            <option value="Cartoon Network">Cartoon Network</option>
            <option value="PBS Kids">PBS Kids</option>
            <option value="Disney Channel">Disney Channel</option>
        </select>
    </p>
    <p>First Aired (year): <input type="text" name="year" required onChange="validYearAdd(this.value);"><span id="year_msg" class="error_msg"></span></p>
    <p>Still Airing (new episodes)?<br>
        <input type="radio" class="choice_radio" name="airing" value="Yes"><span class="label" required> Yes</span>
        <input type="radio" class="choice_radio" name="airing" value="No"><span class="label" required> No</span>
    </p>
    <input type="submit" value="Add" name="submit" id="submit"><span id="submit_msg" class="error_msg"></span>
</form>
</div>

</div>
</body>
</html>
