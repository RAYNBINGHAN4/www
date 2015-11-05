<extend name="Common:index"/>
<block name="list">
	<input type="button" class="button ajax-post" url="{:U('changeStatus')}" value="删除选中"/>
	<div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
			<tr>
				<th width="50px">序号<input type="checkbox"  class="all"/></th>
				<?php
				   foreach($fields as $field){
					  if($field[key]=='PRI'){
							continue;
					  }
					  if( is_int(strpos("$field[comment]",'@'))){
							$field[comment] =  strstr($field[comment],'@',ture);
					  }
					  echo '<th>'.$field[comment].'</th>'."\r\n";
					}
				?>
				<th>操作</th>
			</tr>
			<volist name="rows" id="row">
				<tr>
					<td align="center"><input type="checkbox" name="id[]" class="id" value="{$row.id}"/></td>
					<?php foreach($fields as $field){
                    if($field['key']=='PRI'){
                        continue;
                    }

                    if($field['field']=='status'){
                        echo '<td align="center"><a class="ajax-get" href="{:U(\'changeStatus\',array(\'id\'=>$row[\'id\'],\'status\'=>1-$row[\'status\']))}"><img src="__IMG__/{$row.status}.gif" alt=""/></a></td>';
					    echo "\r\n";
					}else{
                        echo "<td align='center'>{\$row.{$field['field']}}</td>\r\n";
					}
					}
					?>
					<td align="center">
						<a href="{:U('edit',array('id'=>$row['id']))}" title="编辑">编辑</a> |
						<a class="ajax-get" href="{:U('changeStatus',array('id'=>$row['id']))}" title="移除">移除</a>
					</td>
				</tr>
			</volist>
			<tr>
				<td align="right" nowrap="true" colspan="8">
					<div class="page">
						{$pageHtml}
					</div>
				</td>
			</tr>
		</table>
	</div>
</block>