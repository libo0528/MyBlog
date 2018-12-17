<?php
namespace Lib;
class Session {
    private $db;
    public function __construct() {
        session_set_save_handler(
        array($this,'open'),
        array($this,'close'),
        array($this,'read'),
        array($this,'write'),
        array($this,'destroy'),
        array($this,'gc')
        );
        session_start();
    }
    public function open() {
        $this->db = \Core\MyPDO::getinstance($GLOBALS['config']['database']);
        return true;
    }
    public function close() {
        return true;
    }
    public function read($sess_id) {
        $sql = "select sess_value from session where sess_id='$sess_id'";
        //查询的结果必须是字符串 所以在查询结果前 强转成字符串
        return (string)$this->db->fetchColumn($sql);
    }
    public function write($sess_id,$sess_value) {
        $time = time();
        //插入会话，如果此会话的id已经存在，就更新会话
        $sql = "insert into session values ('$sess_id','{$sess_value}',$time)"
                . " on duplicate key update sess_value='{$sess_value}',sess_time=$time";
        return $this->db->exec($sql)!==false;
        //注意，使用不全等，因为可能会返回0
    }
    public function destroy($sess_id) {
        $sql = "delete from session where sess_id='$sess_id'";
        return $this->db->exec($sql) !== false;
    }
    public function gc($lifetime) {
        $time = time() - $lifetime;         //会话过期时间
        $sql = "delete from session where sess_time<$time";
        return $this->db->exec($sql) !== false;
    }
}
