<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
	<meta name = "robots" content = "noindex, nofollow">
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<link href = "http://admin.shop.com/Public/Admin/css/general.css" rel = "stylesheet" type = "text/css"/>
	<link href = "http://admin.shop.com/Public/Admin/css/main.css" rel = "stylesheet" type = "text/css"/>
	
    <link href="http://admin.shop.com/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://admin.shop.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">

</head>
<body>
<h1>
	<span class = "action-span"><a href = "<?php echo U('index');?>">查看<?php echo ($meta_title); ?>名单</a></span>
	<span class = "action-span1"><a href = "#">ECSHOP 管理中心</a></span>
	<span id = "search_id" class = "action-span1"> -  添加<?php echo ($meta_title); ?> </span>

	<div style = "clear:both"></div>
</h1>

    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back">商品描述</span>
            <span class="tab-back">会员价格</span>
            <span class="tab-back">商品属性</span>
            <span class="tab-back">商品相册</span>
            <span class="tab-back">关联文章</span>
        </p>
    </div>
    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品分类</td>
                <td>
                    <input type="hidden" name="goods_category_id" class="goods_category_id" maxlength="60" value="<?php echo ($goods_category_id); ?>">
                    <input type="text" disabled="disabled" name="goods_category_text" class="goods_category_text" maxlength="60" value="请选择下面的分类">
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <ul id="treeDemo" class="ztree"></ul>
                </td>
            </tr>
            <tr>
                <td class="label">品牌</td>
                <td>
                    <?php echo arr2select('brand_id',$brands,$brand_id);?>
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">供货商</td>
                <td>
                    <?php echo arr2select('supplier_id',$suppliers,$supplier_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">本店价格</td>
                <td>
                    <input type="text" name="shop_price" maxlength="60" value="<?php echo ($shop_price); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">市场价格</td>
                <td>
                    <input type="text" name="market_price" maxlength="60" value="<?php echo ($market_price); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">库存</td>
                <td>
                    <input type="text" name="stock" maxlength="60" value="<?php echo ($stock); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">是否上架</td>
                <td>
                    <input type="radio" class="is_on_sale" value="1" name="is_on_sale"/>是
                    <input type="radio" class="is_on_sale"  value="0" name="is_on_sale"/>否
                    <span  class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品状态</td>
                <td>
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="1">精品
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="2">新品
                    <input type="checkbox" class="goods_status" name="goods_status[]" value="4">热销
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">关键字</td>
                <td>
                    <input type="text" name="keyword" maxlength="60" value="<?php echo ($keyword); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">LOGO</td>
                <td>
                    <input type="file" name="upload-logo" id="upload-logo" maxlength="60">
                    <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">
                    <div class="upload-img-box" style="display: <?php echo ($logo?'block':'none'); ?>">
                        <div class="upload-pre-item">
                            <img src="http://raynbinghan-goods.b0.upaiyun.com/<?php echo ($logo); ?>">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">状态</td>
                <td>
                    <input type="radio" class="status" value="1" name="status"/>是
                    <input type="radio" class="status"  value="0" name="status"/>否 <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td class="label">商品描述</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
            <tr>
                <td class="label">会员价格</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
            <tr>
                <td class="label">商品属性</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
            <tr>
                <td class="label">商品相册</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
            <tr>
                <td class="label">关联文章</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <div style="text-align: center">
            <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
            <input type="submit" class="button" value=" 确定 "/>
            <input type="reset" class="button" value=" 重置 "/>
        </div>
    </form>


<div id = "footer">
	共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br/>
	版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
<script type = "text/javascript" src = "http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type = "text/javascript" src = "http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<script type = "text/javascript" src = "http://admin.shop.com/Public/Admin/js/common.js"></script>
<script type = "text/javascript">
	$(function () {
		//选中是否显示的状态
		$('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>
	])
	;
	})
	;
</script>

    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript">
        $(function(){
            //>>是否上架:默认为是.
            $('.is_on_sale').val([1]);
            //////////////////////导航栏特效////////////////////////////////////
            $('#tabbar-div span').click(function(){
                //>>删除和添加class从而改变css样式
                $('#tabbar-div span').removeClass('tab-front').addClass('tab-back');
                $(this).addClass('tab-front').removeClass('tab-back');
                //>>设置表格对应span标签现实和隐藏
                var index =  $(this).index();//代表点击的第几个span
                $('form>table').hide();
                $('form>table').eq(index).show();
            })

            /////////////////////////////商品分类树///////////////////////////////////////////////
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    beforeClick: function (treeId, treeNode, clickFlag) {
                        if (treeNode.isParent) {
                            layer.msg('必须选择最小分类', {
                                offset: 4,
                                icon: 0,
                            });
                        }

                        return !treeNode.isParent;  //如果该分类有子节点, 就返回false, false表示不选中
                    },
                    onClick: function (event, treeId, treeNode) {
                        $('.goods_category_id').val(treeNode.id);
                        $('.goods_category_text').val(treeNode.name);
                    }
                }
            };
            //>>2.准备树中需要的数据
            var zNodes = <?php echo ($nodes); ?>;
            //>>3.将id为treeDemo的ul变为一个树, 返回值就是该树的对象
            var treeObject = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            <?php if(!empty($id)): ?>//下面的代码是编辑时要执行的, 选中商品分类
            var goods_category_id = <?php echo ($goods_category_id); ?>;
            var node  = treeObject.getNodeByParam('id',goods_category_id);
            treeObject.selectNode(node);
            //并且将选中的节点的id,name设置
            $('.goods_category_id').val(node.id);
            $('.goods_category_text').val(node.name);
            <?php else: ?>
            //>>4.使用对象中的方法让其展开(添加的时候全部展开)
            treeObject.expandAll(true);<?php endif; ?>


                /////////////////////////////商品LOOG的上传插件////////////////////////////////////////////
            window.setTimeout(function(){
                $("#upload-logo").uploadify({
                    height: 24,    //指定删除插件的高和宽
                    width: 145,
                    swf: 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
                    uploader: '<?php echo U("Uploader/index");?>',   //在服务器上处理上传的代码
                    'buttonText': '选择图片',   //上传按钮上面的文字
                    'fileSizeLimit': '500KB',  //限制大小
//            'fileObjName' : 'the_files',  //上传文件时, name的值 ,  默认值为  Filedata     $_FIELS['Filedata']
                    'formData': {'dir': 'goods'},   //通过post方式传递的额外参数
                    'multi': true,   //是否支持多文件上传
                    'onUploadSuccess': function (file, data, response) {   //上传成功时执行的方法(data为图片地址)
                        $('.logo').val(data);
                        $('.upload-img-box').show();
                        $('.upload-img-box img').attr('src', "http://raynbinghan-goods.b0.upaiyun.com/" + data);
                    },
                    'onUploadError': function (file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                })


            });


            /////////////////////////////编辑时回显商品状态  开始////////////////////////////////////////////
            <?php if(!empty($id)): ?>var goods_status = <?php echo ($goods_status); ?>;  //该值是一个整数
            var goods_status_values = new Array();
            if((goods_status & 1) > 0){
                goods_status_values.push(1);
            }
            if((goods_status & 2) > 0){
                goods_status_values.push(2);
            }
            if((goods_status & 4) > 0){
                goods_status_values.push(4);
            }
            $('.goods_status').val(goods_status_values);<?php endif; ?>
        })
    </script>

</body>
</html>