<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{

    public function index(){
        if(session('username')==null){
            redirect("/index.php/admin/login/index");
        }
        $cid=session('cid');
        $company=M(companyinfo);
        $info=$company->where("cid=$cid")->find();
        $this->assign('company',$info['cname']);
        $this->display();
    }

    public function logout(){
        session('username',null);
        session('cid',null);
        redirect("/index.php/admin/login/index");
    }

}