<?php
if (isset($_GET['juryId']) && isset($_GET['caseId'])) {
    include_once __DIR__ . '/pages/issueResponse.php';
//no case - no trial
} elseif (isset($_GET['caseId'])){
    include_once __DIR__ . '/pages/trial.php';
} elseif (isset($_GET['routeLists'])) {
    include_once __DIR__ . '/content/php_files/routeLists/routeLists.php';
} elseif (isset($_GET['routeListId'])) {
    include_once __DIR__ . '/content/php_files/routeList/routeList.php';
} elseif (isset($_GET['vMap'])) {
    include_once __DIR__ . '/content/php_files/vehiclesMap/vMap.php';
} else  {
    include_once __DIR__ . '/pages/main.php';
}
?>