<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{

    public  function index()
    {
        $this->display();
    }

    public function login()
    {
        if (!empty($_POST)){
            $login = new \Model\LoginModel();
            $msg = $login->checkNamePwd($_POST['name'], $_POST['pwd']);
            echo $msg;    //1- 成功  2-用户名正确密码错误
        }
    }
}