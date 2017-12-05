<?php

session_start();

if (isset($_SESSION['myusernum'])) {
    $myusn = intval($_SESSION['myusernum']);
} else {
    $myusn = 0;
}

$out = "";

// ----------Database Connection ----------
include_once("../dbconn/MySQLconn.php");
// ----------------End---------------------

include_once("../dao/CHmessageDao.class.php");
$chmsgdao = new CHmessageDao();

include_once("../dao/CHmsg_countDao.class.php");
$chmsgcntdao = new CHmsg_countDao();

if ($myusn > 0) {
    $mymsgcnt = $chmsgcntdao->getMsgCountByUser($conn, $myusn);
    
    $totalmsgcnt = $chmsgdao->countAllMessages($conn);
    
    if ($totalmsgcnt > $mymsgcnt) {
        $mxmsgid = $chmsgdao->getMaxId($conn);
        
        $newmsg = $chmsgdao->getMessageById($conn, $mxmsgid);
        $owner = $chmsgdao->getUserNumById($conn, $mxmsgid);
        
        $out = "<b>User " . $owner . ":</b> " . $newmsg;
        
        $chmsgcntdao->setMsgCountByUser($conn, $myusn, $totalmsgcnt);
    }
}

mysqli_close($conn);

print $out;
?>