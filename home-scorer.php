<?php 
    require_once('srvr/account.php'); 
    account::checkSession();
?>

<html>
    <head>
        <title>DID - Welcome</title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="theme/layout.css"/>
        <link type="text/css" rel="stylesheet" href="theme/home-scorer.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    </head>

    <body>
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <div class="nav-div">
            <img src="SFLS.jpg" width="70px" height="70px"/>
            <a href="index.php" class="link-div">SFLS DI Department</a>
            <a href="home-scoreBoard.php" class="link-div">ScoreBoard</a>
            <a href="home-history.php" class="link-div">History</a>
            <a href="home-scorer.php" class="link-div active">Scorer</a>
        </div>
        
        <div class="pos-center-div">
            <div class="title-div">Welcome! <?php echo $_SESSION['scorer_name']; ?> </div>
            <div class="subtitle-div">It's <?php echo date('y年m月d日',time())?> today. Your score will be updated to scoreboard at 5:30</div>
            <div class="warntitle-div">You must score justful and careful!!</div>
        </div>
        
        <div class="pos-center-div">
       <?php
            require_once('srvr/dbManager.php');
            require_once('srvr/dbSubject.php');
            require_once('srvr/dbClas.php');
            require_once('srvr/table.php');
            require_once('srvr/form.php');

            $subjectName = subject::getNameArray();
            $subjectId = subject::getIdArray();
            $className = clas::getNameArray();
            $classId = clas::getIdArray();            
            
            echo "<form action='handler/scoreSubmit.php' method='POST'>";

            echo form::invisible("score_date", date('y-m-d',time()));
            echo form::invisible("score_time", date('y-m-d h:i:s',time()));
            echo form::invisible("scorer", $_SESSION['scorer_id']);

            table::echoHead($subjectName);
            for ($i = 0; $i < count($classId); $i++) {
                unset($score);
                for ($j = 0; $j < count($subjectId); $j++) {
                    $echoScoreInput = "<input class='input-def' name='score_pos[]' type='text'/>";

                    $echoScoreCla = form::invisible("score_cla[]", $classId[$i]);
                    $echoScoreSub = form::invisible("score_sub[]", $subjectId[$j]);
                    $score[] = $echoScoreInput.' '.$echoScoreCla.' '.$echoScoreSub;
                }
                table::echoRow($className[$i], $score);
            }
            table::echoEnd();

            echo "<button type='submit'>Submit</button>";
            echo "</form>";
        ?>
        </div>
    </body>
</html>