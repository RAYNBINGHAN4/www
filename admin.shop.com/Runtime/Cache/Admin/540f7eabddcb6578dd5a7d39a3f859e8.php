<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>ECSHOP 管理中心 - <?php echo ($meta_supplier); ?> </title>
	<meta name = "robots" content = "noindex, nofollow">
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<link href = "http://admin.shop.net/Public/Admin/css/general.css" rel = "stylesheet" type = "text/css"/>
	<link href = "http://admin.shop.net/Public/Admin/css/main.css" rel = "stylesheet" type = "text/css"/>
	<block name = "css"><!--预留添加css样式的位置--></block>
</head>
<body>
<h1>
	<span class = "action-span"><a href = "<?php echo U('index');?>">查看<?php echo ($meta_supplier); ?>名单</a></span>
	<span class = "action-span1"><a href = "#">ECSHOP 管理中心</a></span>
	<span id = "search_id" class = "action-span1"> -  编辑<?php echo ($meta_supplier); ?> </span>

	<div style = "clear:both"></div>
</h1>

	<form method="post" action="<?php echo U();?>">
		<table cellspacing="1" cellpadding="3" width="100%">
			<tr>
				<td class="label">表名</td>
				<td>
					<input type="text" name="table_name" maxlength="60" />
					<span class="require-field">*</span>
				</td>
			</tr>

			<tr>
				<td colspan="2" align="center"><br />
					<input type="hidden"  name="id" value="<?php echo ($id); ?>" />
					<input type="submit" class="button" value=" 生成代码 " />
					<input type="reset" class="button" value=" 重置 " />
				</td>
			</tr>
		</table>
	</form>


<div id = "footer">
	共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br/>
	版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
<script type = "text/javascript" src = "http://admin.shop.net/Public/Admin/js/jquery-1.11.2.js"></script>
<script type = "text/javascript" src = "http://admin.shop.net/Public/Admin/layer/layer.js"></script>
<script type = "text/javascript" src = "http://admin.shop.net/Public/Admin/js/common.js"></script>
<script type = "text/javascript">
	$(function () {
		//选中是否显示的状态
		$('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>
	])
	;
	})
	;
</script>
<block name = "js"></block>
</body>
</html>