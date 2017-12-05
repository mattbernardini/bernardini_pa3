<?php

//---------Connect Database-----------
include_once("../dbconn/MySQLconn.php");
//---------Connect Database-----------

include_once("../dao/MCvideoDao.class.php");
$mcviddao = new MCvideoDao();

if (isset($_GET['id'])) {
    $vid = intval($_GET['id']);
} else {
    $vid = 0;
}

$ytid = '';

if ($vid > 0) {
    $ytid = $mcviddao->getYoutubeIdById($vid);
}

mysql_close($con);

print $ytid;
?>