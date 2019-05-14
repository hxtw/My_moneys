<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\phpStudy\PHPTutorial\WWW\My_moneys\public/../application/index\view\Dubbing\add_index.html";i:1557555222;}*/ ?>
<!--配音投稿-->
<div class="container-fluid">
    <h3 class="page-title">配音投稿</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3>
                </div>
                <form class="form-auth-small" id="form-dubbing-add" enctype="multipart/form-data">
<!--                    防止二次提交的token-->
                    <input type="hidden" name="add_Jianc" value="<?php echo session('add_Jianc'); ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit['id']; ?>" />
                    <input type="hidden" name="edit_video" id="edit_video" value="<?php echo $edit['video']; ?>" />
                    <input type="hidden" name="edit_name_video"  id="edit_name_video"  value="dubbing_vi_uploads" />
                    <div class="panel-body" id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="control-label sr-only">标题</label>
                            <input type="text" class="form-control input-lg" value="<?php echo $edit['title']; ?>" id="title" placeholder="标题" name="title">
                        </div>
                        <div class="form-group row">
                        </div>
                        <div class="form-group">
                            <input id="file-0a" class="file" type="file"   name="file1"  accept="audio/*">
                        </div>
                        <input type="hidden" name="vidvalue" id="ziyuan_id">
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
<script type="text/javascript">
    // 提交格式判断
    function Panduan(type) {
        if($("#title").val() == ''){
            layer.msg("标题不能为空！", {icon: 5,time:2500});
            return false;
        }
        if (type == 'xiugai'){
            if($("#edit_video").val() == ''){
                layer.msg("视频不能为空！", {icon: 5,time:2500});
                return false;
            }
            editFrom();
        }else if (type == 'tianjia') {
            if($("#ziyuan_id").val() == ''){
                layer.msg("视频不能为空！", {icon: 5,time:2500});
                return false;
            }
            updateFrom();
        }

    }
    var edit_name=$("#edit_name_video").val();
    var e_video=$("#edit_video").val();
    if (e_video) {
        var liulan_v="/My_moneys/public/"+edit_name+"/"+e_video;
    }else {
        var liulan_v= "";
    }
/*    配音上传功能 -配置        */
    $("#file-0a").fileinput({
        dropZoneTitle : "请上传配音！", //标题
        uploadUrl : "<?php echo url('index/Dubbing/add_viadd'); ?>", //上传地址
        language : "zh",//语言
        showCaption : false,//上传名称隐藏
        showUpload : true,//上传按键取消
        overwriteInitial : false, //是否要覆盖初始预览内容和标题设置
        showUploadedThumbs : false, //显示上传缩略图
        maxFileCount : 1, //最大上传文件
        minFileCount : 1, //最小上传文件
        maxFileSize : 153600,//文件最大153600kb=150M
        initialPreviewShowDelete : true, //缩略图显示删除按钮
        showRemove : true,//是否显示删除按钮
        showClose : false,//是否显示预览界面的关闭图标
        autoReplace : true, //是否自动替换预览中的文件
        enctype: 'multipart/form-data',//提交的编码
        validateInitialCount:true,//验证minfilecount和maxfilecount时是否包括初始预览文件计数
        layoutTemplates : {
            actionDelete:'', //去除上传预览的缩略图中的删除图标
            actionUpload:'',//去除上传预览缩略图中的上传图片；
            actionZoom:'',   //去除上传预览缩略图中的查看详情预览的缩略图标。
            },
        allowedFileExtensions : [ "mp3"],//上传格式
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",//当检测到用于预览的不可读文件类型时，在每个预览文件缩略图中显示的图标。
        initialPreviewAsData:true,//开启默认预览功能
        initialPreview: liulan_v,//预览图片、配音的参数
        initialPreviewConfig: [
            {type: "audio", filetype: "audio/mp3", caption: "", url: "", key: 3},
        ],//配音配置
    });

/*    配音上传功能 -上传操作        */
    $('#file-0a').on('fileuploaded',function(event, data, previewId, index) {
        if (data.response.code == "402") {
            layer.msg('上传成功', {
                icon: 1,//提示的样式
                time: 1000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
            });
             $("#ziyuan_id").val(data.response.parameter);
        }else{
            layer.msg('上传失败', {
                icon: 5,//提示的样式
                time: 2000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
            });
            $(event.target)
                .fileinput('clear')
                .fileinput('unlock')
            $(event.target)
                .siblings('.fileinput-remove')
                .hide()
        }
    }).on('fileerror', function(event, data, msg) {
        layer.msg('服务器错误，请稍后再试', {icon: 5});

    });
/*    配音上传功能 -删除操作        */
 $('#file-0a').on('filecleared',function(event) {
        var value =$(" #ziyuan_id").val();
        if (value) {
            $.ajax({
                url: "<?php echo URL('index/Dubbing/add_videl'); ?>",
                type: 'post',
                data: {value},
                success: function (arr) {
                    if(arr.code == "502"){
                        //登录成功
                        layer.msg('删除成功', {
                            icon: 1,//提示的样式
                            time: 1000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
                        });
                        $("#ziyuan_id").val("");
                    }else{
                        layer.msg('删除失败', {icon: 5});
                    }
                },
                error:function(){
                    layer.msg('操作失败', {icon: 5})
                }
            })
        }else{
            $("#ziyuan_id").val("");
        }
    });
</script>
<script type="text/javascript">
    var post_flag = false; //设置一个对象来控制是否进入AJAX过程
    function updateFrom() {
        if(post_flag) return; //如果正在提交则直接返回，停止执行
        post_flag = true;//标记当前状态为正在提交状态
        //加载层
        layer.load();
        $.ajax({
            url: "<?php echo URL('index/Dubbing/Dubbing_add'); ?>",
            type: 'post',
            data: $("#form-dubbing-add").serializeArray(),
            success: function (arr) {
                if(arr == "dub_ok"){
                    //登录成功
                    layer.msg('添加成功', {
                        icon: 1,//提示的样式
                        time: 1000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
                        end:function(){
                            $('#content-load').load("<?php echo url('index/Dubbing/list_index'); ?>");
                        }
                    });
                }else if(arr == "dub_no"){
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
                }else if(arr == "vid_no"){
                    layer.msg('请上传配音', {icon: 5});
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
<script type="text/javascript">
    var post_flag = false; //设置一个对象来控制是否进入AJAX过程
    function editFrom(){
        if(post_flag) return; //如果正在提交则直接返回，停止执行
        post_flag = true;//标记当前状态为正在提交状态
        // 加载层
        layer.load();
        $.ajax({
            url: "<?php echo URL('index/Dubbing/video_edit'); ?>",
            type: 'post',
            data: $("#form-dubbing-add").serializeArray(),
            success: function (arr) {
                if(arr == "dub_ok"){
                    //修改成功
                    layer.msg('修改成功', {
                        icon: 1,//提示的样式
                        time: 1000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
                        end:function(){
                            // location.href="<?php echo url('index/Eqx/list_index'); ?>";
                            $('#content-load').load("<?php echo url('index/Dubbing/list_index'); ?>");
                        }
                    });
                }else if(arr == "dub_no"){
                    layer.msg('修改失败', {icon: 5});
                    post_flag =false;
                }else if(arr == "jianc_no"){
                    layer.msg('请不要重复提交', {icon: 5});
                    post_flag =false;
                }
                post_flag =false;
                setTimeout(function(){
                    layer.closeAll('loading');
                }, 3000);
            },
            error:function(){

                post_flag =false;
            }
        })

    }
</script>
