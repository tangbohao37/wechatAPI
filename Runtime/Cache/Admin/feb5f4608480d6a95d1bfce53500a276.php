<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1 class="page-header"><?php echo ($list[0]['title']); ?><a id="<?php echo ($list[0]['id']); ?>"  onclick="editInfo(<?php echo ($list[0]['id']); ?>)" data-toggle="modal" data-target="#myModal" class="btn btn-link">修改</a></h1>
    <!--    报名概况-->
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-eye fa-5x"></i>

                </div>
                <div class="panel-right">
                    <h3><?php echo ($list[0]['issuetime']); ?></h3>
                    <strong>发布日期</strong>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-retweet fa-5x"></i>
                </div>
                <div class="panel-right">
                    <h3>8,457</h3>
                    <strong>今日报名人数</strong>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-comments fa-5x"></i>

                </div>
                <div class="panel-right">
                    <h3>8,457</h3>
                    <strong>录取人数</strong>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-users fa-5x"></i>

                </div>
                <div class="panel-right">
                    <h3>8,457</h3>
                    <strong>目标人数</strong>
                </div>
            </div>
        </div>
    </div>
    <!--    今日报名人员 留言-->
    <hr>
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    报名留言
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php if(is_array($list0)): $i = 0; $__LIST__ = $list0;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$liuyan): $mod = ($i % 2 );++$i;?><a href="id=<?php echo ($liuyan["uid"]); ?>" class="list-group-item">
                            <span class="badge"><?php echo ($liuyan["uname"]); ?></span>
                            <i class="fa fa-fw fa-comment"></i> <?php echo ($liuyan["umsg"]); ?>
                        </a><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                    </div>
                    <div class="text-right">
                        <a href="#">More Tasks <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    人员概况
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>学校</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($stu0)): $k = 0; $__LIST__ = $stu0;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$stu): $mod = ($k % 2 );++$k;?><tr>
                                    <td><?php echo ($k); ?></td>
                                    <td><?php echo ($stu["uname"]); ?></td>
                                    <td><?php echo ($stu["usex"]); ?></td>
                                    <td><?php echo ($stu["uschool"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <hr>

    <h1 class="page-header"><?php echo ($list[1]['title']); ?><a id="<?php echo ($list[1]['id']); ?>" onclick="editInfo(<?php echo ($list[1]['id']); ?>)" class="btn btn-link">修改</a></h1>
    <!--    报名概况-->
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-eye fa-5x"></i>

                </div>
                <div class="panel-right">
                    <h3><?php echo ($list[1]['issuetime']); ?></h3>
                    <strong>发布日期</strong>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-retweet fa-5x"></i>
                </div>
                <div class="panel-right">
                    <h3>8,457</h3>
                    <strong>今日报名人数</strong>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-comments fa-5x"></i>

                </div>
                <div class="panel-right">
                    <h3>8,457</h3>
                    <strong>录取人数</strong>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <div class="panel text-center">
                <div class="panel-left pull-left green">
                    <i class="fa fa-users fa-5x"></i>

                </div>
                <div class="panel-right">
                    <h3>8,457</h3>
                    <strong>目标人数</strong>
                </div>
            </div>
        </div>
    </div>
    <!--    今日报名人员 留言-->
    <hr>
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    报名留言
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$liuyan1): $mod = ($i % 2 );++$i;?><a href="id=<?php echo ($liuyan1["uid"]); ?>" class="list-group-item">
                                <span class="badge"><?php echo ($liuyan1["uname"]); ?></span>
                                <i class="fa fa-fw fa-comment"></i> <?php echo ($liuyan1["umsg"]); ?>
                            </a><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                    </div>
                    <div class="text-right">
                        <a href="#">More Tasks <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    人员概况
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>S No.</th>
                                <th>姓名</th>
                                <th>性别</th>
                                <th>学校</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($stu1)): $k = 0; $__LIST__ = $stu1;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$stu1): $mod = ($k % 2 );++$k;?><tr>
                                    <td><?php echo ($k+1); ?></td>
                                    <td><?php echo ($stu1["uname"]); ?></td>
                                    <td><?php echo ($stu1["usex"]); ?></td>
                                    <td><?php echo ($stu1["uschool"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <hr>
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