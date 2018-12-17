<?php
namespace Core;
class Model{
        private $table;         //操作的表名
        private $pk;        //主键
	protected $db;
    /*
     * @param $table string 操作的表名
     */
	public function __construct($table=''){
	//被继承时自动调用连接数据库的方法
	$this->initDB();
        $this->getTable($table);
        $this->getPrimaryKey();              
	}
	//初始化数据库 连接
	private function initDB(){
            $this->db=MyPDO::getinstance($GLOBALS['config']['database']);
	}
        //获取表名  如果传递了表名就使用传递的表名，如果没有传递，就通子类的名称获取表名
        private function  getTable($table){
            if($table==''){
                $class_name=basename(get_class($this)); //获取对象属于的类
                $this->table= substr($class_name, 0,-5);
            }else{
                $this->table=$table;
            }
        }
        //获取表的主键
        private function getPrimaryKey(){
            $rs=$this->db->fetchAll("desc `$this->table`");//获取数据库表结构
            foreach ($rs as $rows){
                if($rows['Key']=='PRI'){
                    $this->pk=$rows['Field'];
                    return;
                }
            }
        }
    /*
     * 封装万能的insert语句
     * @param $data array 插入的数据
     * @return int|false 成功：返回自动增长的编号，失败返回false。
     * 操作数据库相关的数据都是以数组的形式传进来
     */
        public function insert($data){
            $keys= array_keys($data);           //获取数组的键
            //每个key上添加反引号 防止关联数组有关键字的存在
            $keys= array_map(function($key){
                return "`{$key}`";
            }, $keys);
            //将keys中的元素用逗号连接   
            $fields= implode(',', $keys);
            //获取元素的值
            $values= array_values($data);
            //将values中所有的值用引号引起来
            $values= array_map(function($value){
                //替换<script
                $value= str_replace('<script', '&lt;script', $value);
                 //替换</script>
                $value= str_replace('</script>', '&lt;/script&gt', $value);
                return "'{$value}'";
            }, $values);
            //将values中的元素用逗号连接起来
            $values= implode(',', $values);
            //拼接SQL语句
            $sql="insert into `$this->table` ($fields) values ($values)";
            if($this->db->exec($sql)){
                return $this->db->getInsertId();
            }
            return false;
        }
        //封装万能的update语句
        public function update($data){
            //获取所有键
            $keys=array_keys($data);
            //获取主键在数组中的下标
            $index= array_search($this->pk, $keys);
            //删除主键元素
            unset($keys[$index]);
            //拼接`键`='值'的格式
            $fields=array_map(function($key) use($data){
                return "`$key`='$data[$key]'";
            },$keys);
            $fields= implode(',', $fields);
            $sql="update `{$this->table}` set $fields where `$this->pk`='{$data[$this->pk]}'";
            return $this->db->exec($sql);
        }
        //封装万能的delete语句
        public function delete($id){
            $sql="delete from `{$this->table}` where `{$this->pk}`={$id}";
            return $this->db->exec($sql);
        }
    /*
     * 封装万能的select语句，返回二维数组
     * @param $order_field string 排序字段，默认主键排序
     * @param $order_type string asc|desc  排序方式
     *@condition  条件 是一个数组。
     * where 1 表示连接多个条件是 可以使用and  没有1 就是 where and 直接连接 报错
     */
    public function select($condition=array(),$order_field='',$order_type='asc'){
        $sql="select * from `{$this->table}` where 1";
        //表单提交过来的条件是字段名为下标的关联数组，所以用foreach连接一下
        foreach ($condition as $k=>$v){
            $sql.=" and `{$k}` = '$v'";
        }
        if($order_field==''){
            $order_field= $this->pk;
        }
        $sql.=" order by `$order_field` $order_type";
        return $this->db->fetchAll($sql);
    }
    //封装万能的Find()方法，获取一条记录
    public function Find($id){
        $sql="select * from `{$this->table}` where `$this->pk`=$id";
        return $this->db->fetchRow($sql);
    }
    public function registerFetch($username){
        $sql="select * from user where user_name='{$username}'";
        return $this->db->fetchRow($sql);
    }
    
}