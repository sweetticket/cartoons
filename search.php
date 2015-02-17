<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search Cartoons</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <script src="js/jquery.js"></script>
    <script src="js/packery.pkgd.min.js"></script>
    <script src="js/valid.js"></script>
    <script type="text/javascript">
        function validate() {
            var year = validYearSearch(document.forms.search_form.year.value);
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
    <p class="search_msg"></p>
    <h2>Search for a Cartoon</h2>
<form name="search_form" action="search.php" method="post" onSubmit="return validate();">
    <p>Keyword(s): <input type="text" name="keywords"></p>
    <p>Channel:<br>
                <input class="channel choice" type="checkbox" name="channel[]" value='Nickelodeon'><span class="channel label"> Nickelodeon</span><br>
                <input class="channel choice" type="checkbox" name="channel[]" value='Cartoon Network'><span class="channel label"> Cartoon Network</span><br>
                <input class="channel choice" type="checkbox" name="channel[]" value='PBS Kids'><span class="channel label"> PBS Kids</span><br>
                <input class="channel choice" type="checkbox" name="channel[]" value='Disney Channel'><span class="channel label"> Disney Channel</span><br>
    </p>
    <p>First Aired (year): <input type="text" name="year" onChange="validYearSearch(this.value);"><span id="year_msg" class="error_msg"></span></p>
    <p>Still Airing (new episodes)?<br>
        <input type="radio" class="choice_radio" name="airing" value="Yes"><span class="label"> Yes</span>
        <input type="radio" class="choice_radio" name="airing" value="No"><span class="label"> No</span>
    </p>
    <input type="submit" value="SEARCH!" name="submit" id="submit"><span id="submit_msg" class="error_msg"></span>
</form>
</div>
  <div id="data_container">
  <?php
  if(isset($_POST['submit'])){
        $keywords = [];
        $channels = [];
        $year = "";
        $airing = "";
        if (isset($_POST['keywords'])){ $keywords = explode(' ', htmlspecialchars(trim($_POST['keywords']))); };
        if (isset($_POST['channel'])){ $channels = $_POST['channel']; };
        if (isset($_POST['year'])){ $year = $_POST['year']; };
        if (isset($_POST['airing'])){ $airing = $_POST['airing']; };

    echo '<ul id="matches">';
    
    $txt_file = file_get_contents('data.txt');
    if (!$txt_file) {
        die("There was a problem opening the data file");
    }
    $counter = 0;
    $rows = explode("\n", $txt_file);
    foreach($rows as $row => $data){
        $row_data = explode('|', $data);
        $title = $row_data[0];
        $channel = $row_data[1];
        $airdate = $row_data[2];
        $current = $row_data[3];
        $match = false;
        if (in_array($channel, $channels)){
            $match = true;
        }
        if (!empty($year)){
            if ($airdate == $year){
                $match = true;
            }else{
                $match = false;
            }
        }
        if (!empty($airing)){
            if ($airing == $current){
                $match = true;
            }else{
                $match = false;
            }
        }
        foreach ($keywords as $keyword){
            if (stripos($title, $keyword) !== FALSE){
                $match = true;
            }
        }
        
        if ($match){
            $counter++;
          echo '<li class="item">' . '<span class="label">Title: </span>' . $title . '<br><span class="label">Channel: </span>' . $channel . '<br><span class="label">First aired: </span>' . $airdate . '<br><span class="label">Still airing: </span>' . $current . '</li>';
        }
        }
    echo '</ul>';
  };
  ?>

  </div>
</div>
</body>
<script src="js/display_data.js"></script>
<script>
    var count = $("#matches").children().length;
    if (count == 0) {
        $(".search_msg").text("No matches for your search.").addClass("error_msg");
    }else{
        $(".search_msg").text("Your search results are displayed below.").addClass("success_msg");
    }
</script>
</html>
