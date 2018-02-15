<?php
namespace DAO;
include_once __DIR__ . '../../util/class/case.php';
$case = new CourtCase($_GET['caseId']);
$opinions = $case->getJuryOpinions();
$description = $case->getCaseDescription();
$caseId = $case->getCaseId();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->


    <link rel="stylesheet" href="../css/trial.css">

    <meta charset="UTF-8">
    <title>Title</title>

</head>
<body>
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Обсуждение тарифов</a></li>
        <li class="breadcrumb-item active">Обсуждение тарифа №<?php echo $_GET['caseId']?></li>
    </ol>
    <div class="jumbotron">
        <?php
        echo "<h3>Обсуждение #$caseId</h3>";

        echo "<p class='lead'>$description</p>";
        ?>
    </div>
<?php
foreach ($opinions as $opinion){

    echo '<div class="card">'.
        "<div class='card-header'>".$opinion['jury_mail']."</div>".
        '<div class="card-block">'.
        '<h5 class="card-title">'.$opinion['opinion'].'</h5>'.
        '<div class="small">'.$opinion['datetime'].'</div>'.
        '</div>'.
        '</div>';
}
?>





    </div>

</body>
</html>