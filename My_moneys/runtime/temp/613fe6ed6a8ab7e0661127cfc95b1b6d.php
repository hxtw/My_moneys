<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\phpStudy\PHPTutorial\WWW\My_moneys\public/../application/index\view\Eqx\add_index.html";i:1557631218;}*/ ?>
<!--易企秀投稿-->
<div class="container-fluid">
    <h3 class="page-title">易企秀投稿</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3>
                </div>
                <form class="form-auth-small" id="form-exp-add">
<!--                    防止二次提交的token-->
                    <input type="hidden" name="add_Jianc" value="<?php echo session('add_Jianc'); ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit['id']; ?>" />
                    <input type="hidden" name="edit_name" id="edit_name" value="eqx_pi_uploads" />
                    <input type="hidden" name="edit_simg" id="edit_simg" value="<?php echo $edit['simg']; ?>" />
                    <input type="hidden" name="edit_himg" id="edit_himg" value="<?php echo $edit['himg']; ?>" />
                    <div class="panel-body" id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="control-label sr-only">标题</label>
                            <input type="text" class="form-control input-lg" value="<?php echo $edit['title']; ?>" id="title" placeholder="标题" name="title">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label sr-only">副标题</label>
                            <input type="text" class="form-control input-lg" value="<?php echo $edit['subheading']; ?>" id="subheading" placeholder="副标题" name="subheading">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label sr-only">URL 地址</label>
                            <input type="text" class="form-control input-lg" value="<?php echo $edit['url']; ?>" id="url" placeholder="URL 地址" name="url">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select class="form-control input-lg" name="industry">
                                    <option value="1">行业</option>
                                    <option value="2">保险</option>
                                    <option value="3">房产</option>
                                    <option value="4">外卖</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control input-lg" name="type">
                                    <option value="11">中国平安</option>
                                    <option value="22">中国人寿</option>
                                    <option value="33">中国泰康</option>
                                    <option value="44">新华保险</option>
                                    <option value="55">太平洋保险</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="" class="control-label sr-only">id</label>
                                <input type="text" class="form-control input-lg" value="<?php echo $edit['id']; ?>" id="id" placeholder="id" name="id">
                            </div>
                            <div class="col-lg-4">
                                <label for="" class="control-label sr-only">code</label>
                                <input type="text" class="form-control input-lg" value="<?php echo $edit['code']; ?>" id="code" placeholder="code" name="code">
                            </div>
                            <div class="col-lg-4">
                                <label for="" class="control-label sr-only">publishTime</label>
                                <input type="text" class="form-control input-lg" value="<?php echo $edit['publishtime']; ?>" id="publishtime" placeholder="publishTime" name="publishtime">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <!--                                头图上传-->
                                <div class="form-group">
                                    <input id="file-b" class="file" type="file"   name="pic1"  accept="image/*">
                                </div>
                                <input type="hidden" name="toutuval" id="toutu_val" >
                            </div>
                            <div class="col-lg-8">
                                <!--                                大图上传-->
                                <div class="form-group">
                                    <input id="file-c" class="file" type="file"   name="pic2"  accept="image/*">
                                </div>
                                <input type="hidden" name="datuval" id="datu_val">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block btn-lg">预览</button>
                        </div>
                        <div class="col-md-6">
                            <?php if(empty($edit['id']) || (($edit['id'] instanceof \think\Collection || $edit['id'] instanceof \think\Paginator ) && $edit['id']->isEmpty())): ?>
                            <button type="button" class="btn btn-success btn-block btn-lg" onclick="Panduan('tianjia')">提交审核</button>
                            <?php else: ?>
                            <button type="button" class="btn btn-success btn-block btn-lg" onclick="Panduan('xiugai')">修改</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" style="color:#CE3C39"><i class="lnr lnr-question-circle"></i> <span>注意事项</span></h3>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var LJ = "/My_moneys/public";
    var addpiu = "<?php echo url('index/Picture/add_pi'); ?>";
    var delpiu = "<?php echo url('index/Picture/del_pi'); ?>";
</script>
<!--头图/大图 ————上传、删除 ————操作-->
<script src="/My_moneys/public/static/video_file/js/My_moneys_picture.js" type="text/javascript"></script>
<script type="text/javascript">
    // 提交格式判断
    function Panduan(type) {
        if($("#title").val() == ''){
            layer.msg("标题不能为空！", {icon: 5,time:2500});
            return false;
        }
        if($("#subheading").val() == ''){
            layer.msg("副标题不能为空！", {icon: 5,time:2500});
            return false;
        }
        var reg=/(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?/;
        if($("#url").val() == ''){
            layer.msg("URL不能为空！", {icon: 5,time:2500});
            return false;
        }else if(!reg.test($("#url").val())){
            layer.msg("请输入正确的URL地址！", {icon: 5,time:2500});
            return false;
        }
        if($("#id").val() == ''){
            layer.msg("id不能为空！", {icon: 5,time:2500});
            return false;
        }
        if($("#code").val() == ''){
            layer.msg("code不能为空！", {icon: 5,time:2500});
            return false;
        }
        if($("#publishtime").val() == ''){
            layer.msg("publishtime不能为空！", {icon: 5,time:2500});
            return false;
        }
        if (type == 'xiugai'){
            if($("#edit_simg").val() == ''){
                layer.msg("头图不能为空！", {icon: 5,time:2500});
                return false;
            }
            if($("#edit_himg").val() == ''){
                layer.msg("大图不能为空！", {icon: 5,time:2500});
                return false;
            }
            editFrom();
        }else if (type == 'tianjia') {
            if($("#toutu_val").val() == ''){
                layer.msg("头图不能为空！", {icon: 5,time:2500});
                return false;
            }
            if($("#datu_val").val() == ''){
                layer.msg("大图不能为空！", {icon: 5,time:2500});
                return false;
            }
            updateFrom();
        }

    }
    var post_flag = false; //设置一个对象来控制是否进入AJAX过程
    function updateFrom() {
        if(post_flag) return; //如果正在提交则直接返回，停止执行
        post_flag = true;//标记当前状态为正在提交状态
        //加载层
        layer.load();
        $.ajax({
            url: "<?php echo URL('index/Eqx/eqx_add'); ?>",
            type: 'post',
            data: $("#form-exp-add").serializeArray(),
            success: function (arr) {
                if(arr == "eqx_ok"){
                    //登录成功
                    layer.msg('添加成功', {
                        icon: 1,//提示的样式
                        time: 1000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
                        end:function(){
                            // location.href="<?php echo url('index/Eqx/list_index'); ?>";
                            $('#content-load').load("<?php echo url('index/Eqx/list_index'); ?>");
                        }
                    });
                }else if(arr == "eqx_ok"){
                    layer.msg('添加失败', {icon: 5});
                    post_flag =false;
                }else if(arr == "toutu_no"){
                    layer.msg('请添加头图', {icon: 5});
                    post_flag =false;
                }else if(arr == "datu_no"){
                    layer.msg('请添加大图', {icon: 5});
                    post_flag =false;
                }else if(arr == "jianc_no"){
                    layer.msg('请不要重复提交', {icon: 5});
                    post_flag =false;
                }
                post_flag =false;
                setTimeout(function(){
                    layer.closeAll('loading');
                }, 2500);
            },
            error:function(){

                post_flag =false;
            }
        })
    }

</script>
<script>
    var post_flag = false; //设置一个对象来控制是否进入AJAX过程
    function editFrom(){
        if(post_flag) return; //如果正在提交则直接返回，停止执行
        post_flag = true;//标记当前状态为正在提交状态
        var data = new FormData(document.getElementById("form-exp-add"));
        //加载层
        layer.load();
        $.ajax({
            url: "<?php echo URL('index/Eqx/eqx_edit'); ?>",
            type: 'post',
            data: $("#form-exp-add").serializeArray(),
            success: function (arr) {
                if(arr == "eqx_ok"){
                    //登录成功
                    layer.msg('修改成功', {
                        icon: 1,//提示的样式
                        time: 1000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
                        end:function(){
                            // location.href="<?php echo url('index/Eqx/list_index'); ?>";
                            $('#content-load').load("<?php echo url('index/Eqx/list_index'); ?>");
                        }
                    });
                }else if(arr == "eqx_no"){
                    layer.msg('修改失败', {icon: 5});
                    post_flag =false;
                }else if(arr == "jianc_no") {
                    layer.msg('请不要重复提交', {icon: 5});
                    post_flag = false;
                }
                    post_flag = false;
                    setTimeout(function () {
                        layer.closeAll('loading');
                    }, 2500);
            },
            error:function(){

                post_flag =false;
            }
        })

    }
</script>