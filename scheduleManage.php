<?php
session_cache_limiter('none');
session_start();
require_once 'sql.php';

$id_code = htmlspecialchars($_POST['id'],ENT_QUOTES);
$date = 'date';
$comment = 'Please set ';

if(!empty($_POST['schedule'])){
    $schedule = htmlspecialchars($_POST['schedule'],ENT_QUOTES);
}
if(!empty($_POST['time'])){
    $time = htmlspecialchars($_POST['time'],ENT_QUOTES);
}else{
    $time = '';
}
if(!empty($_POST['date'])){
    $date = htmlspecialchars($_POST['date'],ENT_QUOTES);
}else{
    $comment.$date;
}
    $insert = new search_id($id_code, 'password');
    if(!empty($schedule) && !empty($time) && !empty($date)){
        $insert->scheduleManage($schedule, $time, $date);
    }
    $show   = $insert->scheduleCheck($date);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Schedule Check</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>ID</th><th>Schedule</th><th>Time</th><th>Date</th>
            </tr>
            <?php
            foreach($show as $value){ ?>
            <tr>
                <td><?php echo $value['id_code']; ?></td>
                <td><?php echo $value['schedule']; ?></td>
                <td><?php echo $value['time']; ?></td>
                <td><?php echo $value['day']; ?></td>
            </tr>
            <?php }?>
        </table>
        <form action="schedule.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id_code; ?>">
            <input type="submit" value="Back">
        </form>
    </body>
</html>
