<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<script>
    $(document).ready(function(){
    $('.myTable').DataTable();
});
</script>
<body>
<?php if(is_array($list)): $n = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($n % 2 );++$n;?><h2 class="sub-header"><?php echo ($vo["title"]); ?><a id="<?php echo ($vo["id"]); ?>" onclick="editInfo(<?php echo ($vo["id"]); ?>)" class="btn btn-link">修改</a></h2>
    <b>发布时间：<?php echo ($vo["issuetime"]); ?></b>
    <div class="table-responsive">
        <form action="/index.php/Admin/Right/chackResume" method="post">
            <input name="wid" type="hidden" value="<?php echo ($vo["id"]); ?>">
            <table id="" class="table table-striped table-hover myTable">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>就读院校</th>
                        <th>联系方式</th>
                        <th>大家评分</th>
                        <th>所在区域</th>
                        <th>是否录用</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(is_array($vo["s"])): $k = 0; $__LIST__ = $vo["s"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($k); ?></td>
                        <td><?php echo ($s["uname"]); ?></td>
                        <td><?php echo ($s["usex"]); ?></td>
                        <td><?php echo ($s["uschool"]); ?></td>
                        <td><?php echo ($s["uphone"]); ?></td>
                        <td><?php echo ($s["upoint"]); ?></td>
                        <td><?php echo ($s["uaddress"]); ?></td>
                        <td>
                            <label class="radio-inline">
      <input type="radio" name="<?php echo ($s["uid"]); ?>" id="inlineRadio1" value="1"> 录用
    </label>
                            <label class="radio-inline">
      <input type="radio" name="<?php echo ($s["uid"]); ?>" id="inlineRadio2" value="0"> 辞退
    </label>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <button type="submit" class="btn pull-right btn-danger">提交</button>
            </table>
        </form>
    </div>
    <hr><?php endforeach; endif; else: echo "" ;endif; ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">修改兼职信息</h4>
            </div>
            <div class="modal-body">
                <form action="/index.php/Admin/Right/updata" class="form-horizontal" method="post" role="form">
                    <input type="hidden" name="wid" id="wid">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">标题</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="title" id="title"  placeholder="标题">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">工作内容</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="workInfo" id="workinfo" placeholder="工作内容">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">开始时间</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="workStartDate" id="workstartdate" placeholder="工作开始时间">
                        </div>
                        <label  class="col-sm-2 control-label">结束时间</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control"  name="workStopDate" id="workstopdate" placeholder="工作结束时间">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">工作地点</label>
                        <div class="col-sm-7">
                            <input type="text" name="address" class="form-control" id="address"  placeholder="工作地点">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">工作要求</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control"  id="request" name="request" placeholder="工作要求">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">工资</label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <input type="text" class="form-control" id="salary" name="salary" placeholder="工资">
                            </div>
                        </div>
                        <div id="isdalysalary" class="col-lg-2 radio">
                            <label>
                                <input type="radio" name="isdalysalary"  value="1" checked>
                                /天
                            </label>
                            <label>
                                <input type="radio" name="isdalysalary"  value="0">
                                /小时
                            </label>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">人数</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" name="num" id="number" class="form-control" placeholder="人数">
                                <span class="input-group-addon">人</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">联系人</label>
                        <div class="col-sm-7">
                            <input type="text" name="person" id="person" class="form-control"  placeholder="联系人">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">联系电话</label>
                        <div class="col-sm-7">
                            <input type="text" name="phone" id="phone" class="form-control"  placeholder="联系电话">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>