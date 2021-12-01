<?php
session_cache_limiter('none');
session_start();
require_once 'sql.php';

$id_code   = 'ID';
$name      = 'NAME';
$email     = 'EMAIL_ADDRESS';
$birthday  = 'BIRTHDAY';
$password  = 'PASSWORD';
$comment   = ' IS MISSING';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!empty($_POST['idToSignIn'])){
        $id_code = $_POST['idToSignIn'];
    }else{
        echo $id_code.$comment;
        exit;
    }
    if(!empty($_POST['name'])){
        $name = $_POST['name'];
    }else{
        echo $name.$comment;
        exit;
    }
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
    }
    if(!empty($_POST['birthday'])){
        $birthday = $_POST['birthday'];
    }
    if(!empty($_POST['passwordToSignIn'])){
        $password = $_POST['passwordToSignIn'];
    }else{
        echo $password.$comment;
        exit;
    }
}

    $user = new search_id($id_code,$password);
    $user->pdoSignIn($name,$email,$birthday);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>REGISTLATION SUCCEEDED</title>
        <body>
            <p>registlation succeeded</p>
            <form action="login.html" method="get">
                <input type="submit" value="TOP-PAGE">
            </form>
        </body>
    </head>
</html>
