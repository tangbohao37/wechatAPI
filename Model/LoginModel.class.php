<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/8
 * Time: 15:15
 */
//父类model
namespace Model;
use  Think\Model;

class LoginModel extends Model{
    function checkNamePwd($name,$pwd){
        $info=$this->where("userName='$name' and passWord='$pwd'")->find();
        if($info){
            session('username',"$name");
            session('cid',$info['cid']);
            return '1';
        }
        return '2';
    }
}