<?php
class moneySet{
    private $salary;
    private $saving;

//コンストラクターの記載方法
//javaと設定方法が違うjavaはthis.setSalary();等
    function __construct($salary){
        $this->salary = $salary;
    }
  //publicで給料等の確認ができるよう処理
    public function getSalary(){
        return $this->salary;
    }
    public function setSalary($salary){
        $this->salary = $salary;
    }

    public function getSaving(){
        return $this->saving;
    }
    public function setSaving($saving){
        $this->saving = $saving;
    }
    public function calc($saving, $out_money){
        $total  = $saving - $out_money;
        //$result = $this->setSaving($total);
        return $total;
    }
    public function salaryIn($saving){
        $total  = $this->salary + $saving;
        //$result = $this->setSaving($total);
        return $total;
    }
}
?>
