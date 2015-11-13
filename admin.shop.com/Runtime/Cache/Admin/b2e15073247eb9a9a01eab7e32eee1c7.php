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
	
    <link href="http://admin.shop.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<h1>
	<span class = "action-span"><a href = "<?php echo U('index');?>">查看<?php echo ($meta_title); ?>名单</a></span>
	<span class = "action-span1"><a href = "#">ECSHOP 管理中心</a></span>
	<span id = "search_id" class = "action-span1"> -  编辑<?php echo ($meta_title); ?> </span>

	<div style = "clear:both"></div>
</h1>

    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
                        <tr>
                <td class="label">菜单名称</td>
                <td>

                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">菜单URL</td>
                <td>

                    <input type="text" name="url" maxlength="60" value="<?php echo ($url); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">父菜单</td>
                <td>

                    <input type="text" name="parent_text" class="parent_text" maxlength="60" disabled="disabled" value="默认为顶级权限"" >
                    <input type="hidden" name="parent_id" class="parent_id" maxlength="60" value="<?php echo ((isset($parent_id) && ($parent_id !== ""))?($parent_id):0); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>

            <tr>
                <td class="label"></td>
                <td>
                    <ul id="treeDemo" class="ztree"></ul>
                </td>
            </tr>
            <tr>
                <td class = "label">菜单权限</td>
                <td>
                    <div id = "permission_ids"></div>
                    <ul id = "treeMenu" class = "ztree"></ul>
                </td>
            </tr>
             <tr>
                <td class="label">简介</td>
                <td>

                    <textarea name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">状态</td>
                <td>

                    <input type="radio" class="status" value="1" name="status"/>是
                    <input type="radio" class="status" value="0" name="status"/>否
                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td class="label">排序</td>
                <td>

                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>
                        <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden"  name="id" value="<?php echo ($id); ?>" />
                    <input type="submit" class="button " value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
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
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/zTree/js/jquery.ztree.excheck-3.5.js"></script>
    <script type="text/javascript">
        $(function(){
  //////////////////////////////////父分类ztree//////////////////////////////////////////////////
            //>>1.树的设置
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    onClick: function(event, treeId, treeNode){
                        $('.parent_id').val(treeNode.id);
                        $('.parent_text').val(treeNode.name);
                    }
                }
            };
            //>>2.准备树中需要的数据
            var zNodes =<?php echo ($nodes); ?>;
            //>>3.将id为treeDemo的ul变为一个树, 返回值就是该树的对象
            var treeObject = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            //>>4.使用对象中的方法让其展开
            treeObject.expandAll(true);

            <?php if(!empty($id)): ?>//说明是编辑, 需要根据父id找到树上的节点, 然后选中(tp标签,有id说明是编辑页面)
            var parent_id = <?php echo ($parent_id); ?>;  //parent_id的值
            //根据parent_id找到对应的节点
            var parentNode =  treeObject.getNodeByParam('id',parent_id);//>>依据父级id=parent_id找到父节点
            if(parentNode){   //如果没有找到父分类,就不再选中
                //选中该节点
                treeObject.selectNode(parentNode);
                //将父节点的name和id赋值给
                $('.parent_id').val(parentNode.id);
                $('.parent_text').val(parentNode.name);
            }<?php endif; ?>

      //////////////////////////////// 权限ztree  ////////////////////////////////////////////////
            //>>1.树的设置
            var setting1 = {
                check:{
                    enable: true
                },
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    onCheck: function(event, treeId, treeNode){
                        //获取到所有选中的节点
                        var nodes =treeObject1.getCheckedNodes(true);
                        //循环出每一个节点, 将节点中的id存放在隐藏域中,然后放到 <div id="permission_ids"></div>
                        $('#permission_ids').empty();
                        $(nodes).each(function(){
                            $("<input name='permission_ids[]' type='hidden' value='"+this.id+"'/>").appendTo("#permission_ids");
                        });
                    }
                }
            };
            //>>2.准备树中需要的数据
            var zNodes1 =<?php echo ($nodes1); ?>;
            //>>3.将id为treeDemo的ul变为一个树, 返回值就是该树的对象
            var treeObject1 = $.fn.zTree.init($("#treeMenu"), setting1, zNodes1);
            //>>4.使用对象中的方法让其展开
            treeObject1.expandAll(true);

            <?php if(!empty($id)): ?>var permission_ids = <?php echo ($permission_ids); ?>;
            $(permission_ids).each(function(){
                //根据每一个权限id,找到每一个权限然后打钩
                var node = treeObject1.getNodeByParam('id',this);
                treeObject1.checkNode(node,true,false,true);  //node:需要选中的节点, 第一个true: 表示选中,  第二个false:表示不关联, 第三true: 表示选中时激活事件
            });<?php endif; ?>
        });
    </script>

</body>
</html>