<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\phpStudy\PHPTutorial\WWW\My_moneys\public/../application/index\view\Eqx\list.html";i:1557134088;}*/ ?>
<!--易企秀投稿 记录-->
<div class="container-fluid">
    <h3 class="page-title">提审记录</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body">
                    <div class="margin-bottom-30">
                        <button type="button" class="btn btn-danger" onclick="whereFrom(3)">未通过</button>
                        <button type="button" class="btn btn-warning" onclick="whereFrom(1)">待审核</button>
                        <button type="button" class="btn btn-success" onclick="whereFrom(2)">审核通过</button>
                    </div>
                    <div class="clearfix"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>标题</th>
                                <th>状态</th>
                                <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                                <?php if(is_array($eqx_list) || $eqx_list instanceof \think\Collection || $eqx_list instanceof \think\Paginator): $i = 0; $__LIST__ = $eqx_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td><?php echo $vo['id']; ?></td>
                                <td><?php echo $vo['title']; ?></td>
                                <td>
                                    <?php switch($vo['isstate']): case "1": ?><span class="label label-warning">待审核</span><?php break; case "2": ?><span class="label label-success">通过</span></td><?php break; case "3": ?><span class="label label-danger">未通过</span><?php break; endswitch; ?>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-xs" onclick="a_hear(1,<?php echo $vo['id']; ?>)">编辑</button>
                                    <button type="button" class="btn btn-info btn-xs">预览</button>
                                </td>
                            </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                    </table>
                    <div class="text-right">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function whereFrom(where_id) {
        $('#content-load').load( "<?php echo url("Index/Eqx/list_index"); ?>" + "?where=" + where_id );
    }

    function a_hear(type,id) {
        $('#content-load').load( "<?php echo url("Index/Eqx/edit_index"); ?>" + "?id=" + id );
    }
</script>