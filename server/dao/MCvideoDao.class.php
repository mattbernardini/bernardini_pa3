<?php

class MCvideoDao {

    public function addVideo($vti, $des, $ytid) {
        $fields = "(title, description, youtube_id)";
        $values = "('$vti', '$des', $ytid)";

        $query = "INSERT INTO video " . $fields . " VALUES " . $values;
        mysql_query($query);
    }
    
    public function countAllVideos() {
        $query = "SELECT COUNT(vid) FROM video";
        $result = mysql_query($query);

        if ($result) {
            $row = mysql_fetch_assoc($result);

            return $row['COUNT(vid)'];
        } else {
            return 0;
        }
    }
    
    public function getMaxId() {
        $query = "SELECT MAX(vid) FROM video";
        $result = mysql_query($query);

        if ($result) {
            $row = mysql_fetch_assoc($result);

            return $row['MAX(vid)'];
        } else {
            return 0;
        }
    }
    
    public function hasVideoByYtid($ytid) {
        $query = "SELECT vid FROM video WHERE youtube_id = $ytid";
        $result = mysql_query($query);

        if ($result) {
            $row = mysql_fetch_assoc($result);
            $vid = $row['vid'];

            if ($vid > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    
    public function getYoutubeIdById($vid) {
        $query = "SELECT youtube_id FROM video WHERE vid = $vid";
        $result = mysql_query($query);

        if ($result) {
            $row = mysql_fetch_assoc($result);

            return $row['youtube_id'];
        } else {
            return "";
        }
    }
    
}

?>