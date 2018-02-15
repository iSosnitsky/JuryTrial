<?php
namespace DAO;
use Exception;
use PHPMailer;
use phpmailerException;

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//print_r(scandir());
include_once $_SERVER['DOCUMENT_ROOT'] . '/util/class/case.php';
include __DIR__."/PHPMailer/PHPMailerAutoload.php";
include __DIR__.'/PHPMailer/class.smtp.php';
//$captcha = $_SESSION['code'];
$err = [];
if (isset($_POST['description'])){
//    if ($_POST['captcha'] != $captcha) {
//        header("Location: /index.php?wrongCaptcha=0");
//    } else {
        $response = CourtCase::newCase($_POST['description']);
        if ($response){
            foreach (CourtCase::getAllJury() as $jury){
                utf8mail($jury['jury_mail'],'Экспертиза по тарифу', "Текст: <br>".$_POST['description']."<br> <a href='http://185.75.182.94:20118/?caseId=".$response['case_id']."&juryId=".$jury['jury_id'].'\'>Перейте к странице</a>"');
            }
            header("Location: /index.php?caseId=".$response['case_id']);
        }
//    }
}

function utf8mail($to, $s, $body, $from_name = "Logicsmart", $from_a = "info@logicsmart.ru", $reply = "info@logicsmart.ru")
{

//    $mail = new PHPMailer(true);
//    $mail->isSMTP();
//    try {
//        $mail->CharSet = "UTF-8";
//        $mail->Host = "smtp.mail.ru";
//        $mail->SMTPDebug = 0;
//        $mail->SMTPAuth = true;
//        $mail->Port = 465;
//        $mail->Username = "tarificationSquad@bk.ru";
//        $mail->Password = "Fgsfds12";
//        $mail->addReplyTo("tarificationSquad@bk.ru");
//        $mail->replyTo = "tarificationSquad@bk.ru";
//        $mail->setFrom("tarificationSquad@bk.ru");
//        $mail->addAddress($to);
//        $mail->Subject = htmlspecialchars($s);
//        $mail->msgHTML($body);
//        $mail->SMTPSecure = 'ssl';
//        $mail->send();
////    echo "Message sent Ok!</p>\n";
//    } catch (phpmailerException $e) {
//        echo $e->errorMessage();
//    } catch (Exception $e) {
//        echo $e->getMessage();
//    }
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    try {
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->Username = "isosnitsky@gmail.com";
        $mail->Password = "no password for you, curious one";
        $mail->addReplyTo("isosnitsky@gmail.com");
        $mail->replyTo = "isosnitsky@gmail.com";
        $mail->setFrom("isosnitsky@gmail.com");
        $mail->addAddress($to);
        $mail->Subject = htmlspecialchars($s);
        $mail->msgHTML($body);
        $mail->send();
        return true;
//    echo "Message sent Ok!</p>\n";
    } catch (phpmailerException $e) {
        echo $e->errorMessage();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
?>