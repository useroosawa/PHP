<?php
session_cache_limiter('none');
session_start();
require_once 'dbx.php';
require_once 'user_check.php';

class search_id{
    private $id_code;
    private $password;
    private $comment;

    function __construct($id_code,$password){
        $this->id_code  = $id_code;
        $this->password = $password;
    }
    public function getId(){
        return $this->id_code;
    }
    function setId($id_code){
        $this->id_code = $id_code;
    }
    public function getPassword(){
        return $this->password;
    }
    function setPassword($password){
        $this->password = $password;
    }
    public function pdoUser(){
        try{
            DBX::connect();
            $sql = "SELECT * FROM tbl_personal
            WHERE id_code = '$this->id_code'";
            $state = DBX::$pdo->query($sql);
            $count = $state->rowCount();
            $list  = $state->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo($e->getMessage());
        }
        $check = new userCheck($list);
        $comment = $check->search($this->id_code,$this->password);
        if(!empty($comment)){
            echo $comment;?>
            <!DOCTYPE html>
            <html>
                <body>
                    <form action="login.html" method="post">
                        <input type="submit" value="TOP-PAGE">
                    </form>
                </body>
            </html>
            <?php exit;
        }
    }
    public function moneyCheck(){
        try{
            DBX::connect();
            $sql = "SELECT * FROM tbl_moneyManage
            WHERE id_code = '$this->id_code'";
            $state = DBX::$pdo->query($sql);
            $count = $state->rowCount();
            $list  = $state->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo($e->getMessage());
        }
        return $list;
    }

    public function scheduleCheck($date){
        try{
            DBX::connect();
            $sql = "SELECT * FROM tbl_schedule
            WHERE id_code = '$this->id_code' AND
            day = '$date'";
            $state = DBX::$pdo->query($sql);
            $count = $state->rowCount();
            $list  = $state->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $list;
    }
    public function pdoSignIn($name,$email,$birthday){
        try{
            DBX::connect();
            $sql = "INSERT INTO tbl_personal (id_code, name, email, birthday, password)
            VALUES(:id_code, :name, :email, :birthday, :password)";
            $state = DBX::$pdo->prepare($sql);
            $state->BindValue(':id_code', $this->id_code);
            $state->BindValue(':name', $name);
            $state->BindValue(':email', $email);
            $state->BindValue(':birthday', $birthday);
            $state->BindValue(':password', $this->password);
            $state->execute();
        }catch(Exception $e){
            echo($e->getMessage());
        }
    }

    public function moneyManage(int $salary, int $saving, int $out_money, String $product, $date){
        try{
            DBX::connect();
            $sql = "INSERT INTO tbl_moneyManage (id_code, salary, saving, out_money, product, day)
            VALUES(:id_code, :salary, :saving, :out_money, :product, :day)";
            $state = DBX::$pdo->prepare($sql);
            $state->BindValue(':id_code', $this->id_code);
            $state->BindValue(':salary', $salary);
            $state->BindValue(':saving', $saving);
            $state->BindValue(':out_money', $out_money);
            $state->BindValue(':product', $product);
            $state->BindValue(':day',$date);
            $state->execute();
        }catch(Exception $e){
            echo($e->getMessage());
        }
    }

    public function scheduleManage($schedule, $time, $date){
        try{
            DBX::connect();
            $sql = "INSERT INTO tbl_schedule (id_code, schedule, time, day)
            VALUES (:id_code, :schedule, :time, :day)";
            $state = DBX::$pdo->prepare($sql);
            $state->BindValue(':id_code', $this->id_code);
            $state->BindValue(':schedule', $schedule);
            $state->BindValue(':time', $time);
            $state->BindValue(':day', $date);
            $state->execute();
        }catch(Exception $e){
            echo($e->getMessage());
        }
    }
}
?>
