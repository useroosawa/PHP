<?php
session_cache_limiter("none");
session_start();
require_once 'dbx.php';
require_once 'money.php';
require_once 'sql.php';
$id_code = '';
$salary  = '';
$saving  = '';
$date    = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!empty($_POST['id'])){
        $id_code = $_POST['id'];
    }
    if(!empty($_POST['salary'])){
        $salary = $_POST['salary'];
    }
    if(!empty($_POST['saving'])){
        $saving = $_POST['saving'];
    }
    if(!empty($_POST['out_money'])){
        $out_money = $_POST['out_money'];
    }
    if(!empty($_POST['product'])){
        $product = $_POST['product'];
    }
    if(!empty($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d');
    }
}
    // date explodes. on the salary-day, $salary automatically has a value
    //$checkDate = date("Y-m-d", strtotime($date));
    list($y,$m,$d) = explode('-', $date);
    if($d === '20'){
        $salary = 2000;
    }else{
        $salary = 0;
    }
    if($out_money == 0){
        $out_money = 0;
        $product   = 'saving';
    }
    if(($salary != 0) && ($$out_money != 0) ){
        if((!empty($id_code)) && (!empty($saving)) && (!empty($out_money) || $out_money == 0) &&
            (!empty($product)) && (!empty($date))){
                if($salary > 0){
                    $moneyInfo   = new moneySet($salary);
                    $resultIn  = $moneyInfo->salaryIn($salary, $saving);
                    $resultOut = $moneyInfo->calc($resultIn, $out_money);
                    $insert = new search_id($id_code,'password');
                    $insert->moneyManage($salary,$resultOut,$out_money,$product,$date);
                }else{
                    $moneyInfo   = new moneySet($salary);
                    $resultOut = $moneyInfo->calc($saving, $out_money);
                    $insert = new search_id($id_code,'password');
                    $insert->moneyManage($salary, $resultOut, $out_money, $product, $date);
                }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Money_in</title>
    </head>
    <body>
        <form action="money_in.php" method="post">
            <label for="id">ID:</label><br/>
            <input type="readonly" name="id"     id="id" value="<?php echo $id_code; ?>"><br/>
            <label for="salary">Salary:</label><br/>
            <input type="number"   name="salary" id="salary" value="<?php if(empty($salary)){ $salary = 0; } echo $salary;?>"><br/>
            <label for="saving">Saving:</label><br/>
            <input type="number"   name="saving" id="saving" value="<?php echo $saving; ?>"><br/>
            <label for="out_money">Out_money:</label><br/>
            <input type="number"   name="out_money" id="out_money"><br/>
            <label for="product">Product:</label><br/>
            <input type="text"     name="product" id="product"><br/>
            <label for="date">Date:</label><br/>
            <input type="date"     name="date"  id="date" value="<?php echo date('Y-m-d');?>"><br/>
            <input type="submit"   value="ADD RECORDS">
        </form>
        <form action="moneyManage.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id_code; ?>">
            <input type="submit" value="BackPage">
        </form>
    </body>
</html>
