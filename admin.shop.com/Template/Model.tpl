namespace Admin\Model;


use Think\Model;

class <?php echo $name ?>Model extends BaseModel
{
// 自动验证
protected $_validate = array(
    <?php
       foreach($fields as $field){
          if($field['key']=='PRI'||$field['null']=='yes'){
                continue;
          }
          if( is_int(strpos("$field[comment]",'@'))){
                $field[comment] =  strstr($field[comment],'@',ture);
          }
          echo  'array('."'$field[field]'".',"require",'."'$field[comment]不能够为空!'),\r\n";
        }

    ?>

);
}