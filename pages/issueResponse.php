<?php
namespace DAO;
include_once __DIR__ . '../../util/class/case.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$case = new CourtCase($_GET['caseId']);
$description = $case->getCaseDescription();
$caseId = $case->getCaseId();
$jury_id = $_GET['juryId'];
foreach ($case->getJuryOpinions() as $opinion){
    if($opinion['jury_id']==$jury_id && $opinion['isOpen']!=1){
        header("Location: /index.php?caseId=".$caseId);
    }
}
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
    <title>Ответ на обсуждение №<?php echo $caseId?></title>
</head>
<body>
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Обсуждения тарифов</a></li>
        <?php
        echo"<li class=\"breadcrumb-item\"><a href=\"/?caseId=$caseId\"> Обсуждение №$caseId </a></li>"
        ?>

        <li class="breadcrumb-item active">Ответ</li>
    </ol>
    <div class="jumbotron">
        <?php
        echo "<h3>Обсуждение #$caseId</h3>";

        echo "<p class='lead'>$description</p>";
        ?>
    </div>
    <form class="card" style="width: 20rem;" action="pages/sendResponse.php" type="post">
        <div class="card-header">
            Ответ
        </div>
        <div class="card-block">
            <div class="card-title">
                Ваша цена:
            </div>
            <div class="small">
                (Без НДС)<br>
                Указать можно только 1 раз
            </div>
            <input name="jid" value="<?php echo $jury_id?>" hidden>
            <input name="caseId" value="<?php echo $caseId?>" hidden>
            <div class="form-group">
                <input class="form-control" style="text-align: center" name="opinion">
            </div>
            <input type="submit" class="btn btn-primary" value="Отправить">
        </div>
    </form>
</body>
