<?php
namespace Admin\Controller;
use Think\Controller;
class RightController extends Controller{

    public function index(){
        $cid=session('cid');
        $work=M(issue);
//        $k = $work->field('s.uname,s.usex,s.uschool,r.umsg,i.title,i.issuetime')->table('issue i')->join("resume r on i.id=r.wid")->join("studentinfo s on s.uid= r.id")->where("i.cid=$cid")->order('i.id desc')->limit(2)->select();
        $a=$work->field("id,title,issuetime")->where("cid=$cid")->order('issuetime desc')->limit(2)->select(); // 获取公司id 对应的 工作id
        $wid0=$a[0]['id'];
        $wid1=$a[1]['id'];
        $resume=M(resume);
        $b=$resume->field("r.umsg,s.uname,s.uid")->table("resume r")->join("studentinfo s on s.uid = r.uid")->where("r.wid=$wid0 and ischack=0 and r.umsg!=''")->select();
        //获取工作ID 对应的留言
        $c=$resume->field("s.usex,s.uname,s.uid,s.uschool")->table("resume r")->join("studentinfo s on s.uid = r.uid")->where("r.wid=$wid0")->select();//获取工作ID 对应的基本信息
        $b1=$resume->field("r.umsg,s.uname,s.uid")->table("resume r")->join("studentinfo s on s.uid = r.uid")->where("r.wid=$wid1 and ischack=0 and r.umsg!=''")->select();
        $c1=$resume->field("s.usex,s.uname,s.uid,s.uschool")->table("resume r")->join("studentinfo s on s.uid = r.uid")->where("r.wid=$wid1")->select();
        $this->assign('list0',$b);
        $this->assign('stu0',$c);
        $this->assign('list1',$b1);
        $this->assign('stu1',$c1);
        $this->assign('list',$a);
        $this->display('index');
    }

    public function issue(){
        $this->display('issue');
    }

    public function fabu(){
        dump(session('cid'));
        dump($_POST);
        if (!empty($_POST)){
            $data['title']=$_POST['title'];
            $data['workinfo']=$_POST['workInfo'];
            $data['workStartDate']=$_POST['workStartDate'];
            $data['workStopDate']=$_POST['workStopDate'];
            $data['address']=$_POST['address'];
            $data['request']=$_POST['request'];
            $data['salary']=$_POST['salary'];
            $data['isdalysalary']=$_POST['isdalysalary'];
            $data['num']=$_POST['num'];
            $data['contectperson']=$_POST['person'];
            $data['phone']=$_POST['phone'];
            $data['cid']=session('cid');
            $data['issuetime']=date("Y-m-d") ;
            dump($data);
            $issue=M(issue);
            $m=$issue->data($data)->add();
//            if($m){
//                $this->success('添加成功','/index.php/admin',3);
//            }
        }
    }

    public function table(){
        $cid=session('cid');
        $work=M(issue);
        $resume=M(resume);
        $a=$work->field("id,title,issuetime")->where("cid=$cid and TO_DAYS(NOW()) - workStartDate < 0")->select(); // 获取公司id 对应的 工作id
        for($i=0;$i<sizeof($a);$i++){
            $this->assign("stu",$i);
            //获取工作ID 对应的基本信息
            $c=$resume->field("s.usex,s.uname,s.uid,s.uschool,s.uphone,s.upoint,s.uaddress,r.wid")->table("resume r")->join("studentinfo s on s.uid = r.uid")->where("r.wid=".$a[$i]['id']." and r.ischack=0")->select();
            $a[$i]['s']=$c;
        }
        $this->assign('list',$a);
//        $c=$resume->field("s.usex,s.uname,s.uid,s.uschool,s.uphone,i.issuetime,i.title,s.upoint,s.uaddress,r.wid")->table("resume r")->join("studentinfo s on s.uid = r.uid")
//->join("issue i on i.id=r.wid")->where("i.cid=$cid and TO_DAYS(NOW()) - TO_DAYS(workStartDate) < 0")->select();//获取公司ID 对应的报名学生基本信息
//        $this->assign('list',$c);
//        $issue=M(issue);
//        $a=$issue->where("id=1")->select(); // 获取公司id 对应的 工作id
//        dump($a);
        $this->display("table");
    }

    public function chackResume(){
        dump($_POST);
        $wid=$_POST['wid'];
        $_POST['cid']=$_SESSION['cid'];
        $recruit=M("recruit");
        $resume=M("resume");
        foreach($_POST as $key=>$value){
            if(0!=preg_match("/^[0-9]*$/",$key)){
                if($value==1){
                    $_POST["uid"]=$value;
                    $recruit->field("uid,wid,cid")->data($_POST)->add();
                }
                $resume->where("uid=$value and wid=$wid")->setField('ischack',1);
            }
        }
        $this->success("提交成功");
    }

    public function company(){
        $this->display();
    }

    public function alterCompany(){
        if(!empty($_POST)){
            $data['cName']=$_POST['cname'];
            $cid=session('cid');
            $data['cAddress']=$_POST['caddress'];
            $data['cInfo']=$_POST['cinfo'];
//            dump($data);
            $m=M("companyinfo")->where("cid=$cid")->save($data);
            if($m){
                $this->success('添加成功','/index.php/admin',2);
            }
            else{
                $this->error('数据库写入失败');
            }
        }
        else{
            $this->error('服务器未接收到数据');
        }
    }

    public function alterIssue(){   /// ajax    json
        $wid=$_POST['wid'];
        $issue=M(issue);
        $a=$issue->where("id=$wid ")->select(); // 获取公司id 对应的 工作id
//        dump($a);
        echo json_encode($a[0]);
    }

    public function updata(){
        $wid=$_POST['wid'];
        $m=M(issue)->where("id=$wid")->save($_POST);
        if($m){
            $this->success('添加成功','/index.php/admin',2);
        }
        else{
            $this->error('新增失败');
        }
    }
}