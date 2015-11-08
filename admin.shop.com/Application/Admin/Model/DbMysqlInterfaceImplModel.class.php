<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/5
 * Time: 17:13
 */

namespace Admin\Model;


class DbMysqlInterfaceImplModel implements DbMysqlInterfaceModel
{
    public function connect()
    {
        echo 'connect';
        exit;
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect';
        exit;
    }

    public function free($result)
    {
        // TODO: Implement disconnect() method.
        echo 'free';
        exit;
    }

    public function query($sql, array $args = array())
    {
        $targetSQL = $this->buildSQL(func_get_args());
        return M()->execute($targetSQL);
    }

    public function insert($sql, array $args = array())
    {
        $params = func_get_args();
        $sql = $params[0];
        $sql = str_replace('?T', $params[1], $sql);

        //�������ֵ������
        $values = array();
        foreach ($params[2] as $k => $v) {
            $values[] = "$k='$v'";
        }
        $values = implode(',', $values);

        //�������ֵ�滻��$sql��?
        $sql = str_replace('?%', $values, $sql);
        $result = M()->execute($sql);
        if ($result !== false) {
            //ִ�гɹ�֮��Ҫ����id
            return M()->getLastInsID();
        } else {
            return false;//ִ��ʧ��,����false
        }
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'update';
        exit;
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'getAll';
        exit;
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'getAssoc';
        exit;
    }


    /**
     * @param string $sql
     * @param array $args
     * @return mixed  �����ǲ�ѯ������һ������
     */
    public function getRow($sql, array $args = array())
    {
        //>>1.��ƴ��sql
        $targetSQL = $this->buildSQL(func_get_args());
        //>>2.��ִ��?
        $rows = M()->query($targetSQL);
        if (!empty($rows)) {
            return $rows[0];
        }
    }

    /**
     * ���ݲ���ƴsql
     */
    private function buildSQL($params)
    {
        $sql = array_shift($params);  //��params�еĵ�һ��Ԫ�ص���, ��������һ��sqlģ��
        $sqls = preg_split("/\?[FNT]/", $sql);  //��sqlģ����зָ�
        $targetSQL = '';  //����ƴ�Ӻõ�sql
        foreach ($sqls as $k => $v) {
            $targetSQL .= $v . $params[$k];   //��sqlģ���ʵ�ʲ�������ƴ��Ϊ������sql
        }
        return $targetSQL;
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'getCol';
        exit;
    }

    public function getOne($sql, array $args = array())
    {
        $sql = $this->buildSQL(func_get_args());
        $rows = M()->query($sql);

        //��ȡ���������еĵ�һ��ֵ
        $values = array_values($rows[0]);
        return $values[0];
    }

}