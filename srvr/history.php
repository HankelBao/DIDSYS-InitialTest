<?php
require_once('dbManager.php');
require_once('dbScorer.php');
require_once('dbClas.php');
require_once('dbSubject.php');
class history {
    public static function echoHistory($condition) {
            $connection = dbManager::createConnection();
            $tmpSQL = "SELECT * FROM record ".$condition;
            $result = mysqli_query($connection, $tmpSQL);
            dbManager::checkResult($result);
        
           echo "<ul>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<li>";
                echo "评分员".scorer::getNameById($row['rcrd_ScorerId'])."在".$row["rcrdScoreTime"]."给".clas::getNameById($row["rcrd_ClassId"])."对于".subject::getNameById($row["rcrd_SubjectId"])."评分".$row["rcrdScore"];
                echo "</li>";
            }
           echo "</ul>";
    }
}
?>