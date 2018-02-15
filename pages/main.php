<?php
namespace DAO;
session_start();
include_once __DIR__ . '../../util/class/case.php';
$cases = CourtCase::getAllCases();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Мировой Суд Логистики</title>
    <script src="../media/bootstrap-4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../media/bootstrap-4.0.0/css/bootstrap.min.css">
    <!-- Optional theme -->

    <!-- Latest compiled and minified JavaScript -->

    <link rel="stylesheet" href="../css/main.css">





</head>
<body>
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Обсуждение тарифов</li>
    </ol>
    <div class="row">
        <div class="col-6 scrollable">
            <div class="list-group">
                <?php
                foreach ($cases as $case) {
                    echo "<a href=\"index.php?caseId=" . $case['case_id'] . "\" class='list-group-item list-group-item-action flex-column align-items-start'>" .
                        '<div class="d-flex w-100 justify-content-between">' .
                        '<h5 class="mb-1">Обсуждение тарифа №' . $case['case_id'] . '</h5>' .
                        '<small>' . $case['time_created'] . '</small>' .
                        '</div>' .
                        '<p class="mb-1 ellipsis">' . $case['description'] . '</p>' .
                        '</a>';
                }
                ?>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <form action="pages/newIssue.php" method="post" style="text-align: left">
                <h5 class="h5">Новое обсуждение</h5>
                <div class="form-group">
                    <label>Описание маршрута
                        <textarea class="form-control text-lg-center" rows="5" name="description" <?php if (isset($_GET['text'])) echo "value='".$_GET['text']."'";?>></textarea>
                    </label>
                </div>
<!--                <div class="form-group">-->
<!--                    <label>Введите код с картинки:<br>-->
<!--                        <img class="captcha" onclick="this.src = '../util/captcha.php?' + Math.random();" src="../util/captcha.php"/><br>-->
<!--                        <input name="captcha">-->
<!--                        --><?php
//                        if (isset($_GET['wrongCaptcha'])){
//                            echo '<p class="text-danger">Код введён неправильно</p>';
//                        }
//                        ?>
<!--                    </label>-->
<!--                </div>-->
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Отправить">
                </div>
            </form>
        </div>


    </div>
</div>
</body>
</html>