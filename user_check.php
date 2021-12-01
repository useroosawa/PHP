<?php

class userCheck{
    private $list;
    private $commentUser;
    private $commentPassword;

    function __construct($list){
        $this->list = $list;
        $this->commentUser     = 'user does not exist';
        $this->commentPassword = 'password is incorrect';
    }
    public function getList(){
        return $this->list;
    }

    public function search($id_code,$password){
        foreach($this->list as $value){
            array($value['id_code'],$value['name'],$value['email'],
                    $value['birthday'],$value['password']);
        }
        if($id_code != $value['id_code']){
                return $this->commentUser;
        }else if($password != $value['password']){
                return $this->commentPassword;
        }else {
                return '';
        }
    }
}
