<?php
session_cache_limiter('none');
session_start();
$id_code = htmlspecialchars($_POST['id'],ENT_QUOTES);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>schedule</title>
    </head>
    <body>
        <div>
            <form action="scheduleManage.php" method="post" onchange="schedule();">
                <label for="id">ID: </label>
                <input type="text" name="id" id="id" value="<?php echo $id_code;?>"><br/>
                <label for="anything">Schedule: </label>
                <input type="text" name="schedule" id="anything" placeholder="Type Your schedule"><br/>
                <label for="time">Time: </label>
                <input type="time" name="time" id="time"><br/>
                <label for="time">Date: </label>
                <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>"><br/>
                <input type="submit" value="Schedule">
            </form>
        </div>
        <div>
            <form action="life.php" method="post">
                <input type="hidden" name="flag" value="1">
                <input type="hidden" name="id" id="id" value="<?php echo $id_code;?>"><br/>
                <input type="submit" value="Back">
            </form>
        </div>
    </body>
</html>
