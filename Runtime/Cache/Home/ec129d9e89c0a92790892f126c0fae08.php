<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link rel="stylesheet" href="../Common/css/jquery.mobile.min.css" />-->
	<!--<link rel="stylesheet" href="../Common/css/theme.min.css" />-->
	<!--<script src="../Common/js/jquery.min.js"></script>-->
	<!--<script src="../Common/js/jquery.mobile.min.js"></script>-->
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>bootstrap.min.css">
    <!--<link rel="stylesheet" href="../Common/css/bootstrap.min.css">-->
</head>

<body style="font-size:1.5em">
    <div class="panel panel-default">
        <div data-role="header" data-id="myHeader" data-position="fixed"  data-tap-toggle="false">
			<h1>近期兼职</h1>
		</div>
        <div class="panel-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php if(is_array($worklist)): $i = 0; $__LIST__ = $worklist;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$work): $mod = ($i % 2 );++$i;?><div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading<?php echo ($work["id"]); ?>">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($work["id"]); ?>" aria-expanded="false" aria-controls="collapse<?php echo ($work["id"]); ?>">
                                <h4 class="panel-title">
                                <?php echo ($work["title"]); ?>
                                </h4>
                            </a>
                        </div>
                        <div id="collapse<?php echo ($work["id"]); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo ($work["id"]); ?>">
                            <div class="panel-body">
                                <?php echo ($work["workinfo"]); ?>
                            </div>
                            <div>
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-lg btn-primary" onclick="editInfo(<?php echo ($work["id"]); ?>)">
                                        申请兼职
                                    </button>
                                    <a href="http://www.wechat.com/index.php/home/workinfo/workinfo/wid/<?php echo ($work["id"]); ?>" type="button" class="btn btn-lg pull-right btn-primary">
                                        查看详情
                                    </a>
                            </div>
                        </div>
                    </div><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/index.php/Home/Workinfo/workSubmit" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">留言</h4>
                    </div>
                    <input type="hidden" name="wid" id="field＿name" value="value">
                    <div class="modal-body">
                        <textarea id="note" name="umsg" class="form-control" style="resize:none" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Submit</button>
                        <!--onclick="submit()"-->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo (JS_URL); ?>jquery-1.11.1.min.js"></script>
    <!--<script src="../Common/js/jquery-1.11.1.min.js"></script>-->
    <script src="<?php echo (JS_URL); ?>bootstrap.min.js"></script>

    <script src="<?php echo (JS_URL); ?>js.js"></script>
    <!--<script src="../Common/js/bootstrap.min.js"></script>-->
</body>

</html>