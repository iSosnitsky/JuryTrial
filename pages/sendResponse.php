<?php
namespace DAO;
include_once __DIR__ . '../../util/class/case.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$case = new CourtCase($_GET['caseId']);
$opinion = $_GET['opinion'];
$caseId = $case->getCaseId();
$jury_id = $_GET['jid'];
$case->setOpinion($jury_id,$opinion);
header("Location: /index.php?caseId=".$caseId);
?>