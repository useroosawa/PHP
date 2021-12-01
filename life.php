<?php
/*these names have used for somethings.
$user
$list
$comment
$commentUser
$commentPassword
$date
*/
session_cache_limiter('none');
session_start();
require_once 'sql.php';

$id_code  = '';
$password = '';
$flag     = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!empty($_POST['id'])){
        $id_code = $_POST['id'];
    }else{
        echo 'put your ID to log in';
        exit;
    }
    if(!empty($_POST['password'])){
        $password = $_POST['password'];
    }else if($_POST['flag'] == 1){
        $flag = $_POST['flag'];
    }else{
        echo 'put your password to log in';
        exit;
    }
}
    if($flag != 1){
    $user = new search_id($id_code,$password);
    $user->pdoUser();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>moneyManagement</title>
    </head>
    <body>
        <h2>life</h2>
        <form action="moneyManage.php" method="post">
        <!--get a date by java script-->
            <input type="hidden" name="id" value="<?php echo $id_code;?>">
            <input type="submit" name="moneyManage" value="moneyManage">
        </form>
        <form action="schedule.php" method="post">
            <input type="submit" value="schedule Manage">
            <input type="hidden" name="id" value="<?php echo $id_code; ?>">
        </form>
        <form action="login.html" method="post">
            <input type="submit" value="TOP-PAGE">
        </form>
    </body>
</html>
