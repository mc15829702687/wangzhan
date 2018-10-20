<?php
class db{

//类成员属性，引用要使用$this->linkid   $this->sqlid   $this->record
var $linkid;//数据库连接资源
var $sqlid;//mysql_query()执行之后的返回的资源集
var $record;//mysql_fetch_array()之后的结果集

/*
 * 链接数据库服务器以及选择数据库,并设置编码
 * 构造函数啊
 */
function db($host="",$username="",$password="",$database="")
{
    if(!$this->linkid)     
    @$this->linkid = mysql_connect($host, $username, $password) or die("连接服务器失败.");
    @mysql_select_db($database,$this->linkid) or die("无法打开数据库");
    mysql_query("set names utf8");//设置编码
    return $this->linkid;
}
/*
 *对执行sql语句操作数据库
 *mysql_query() 仅对 SELECT，SHOW，EXPLAIN 或 DESCRIBE 语句返回一个资源标识符
 *如果查询执行不正确则返回 FALSE。
 */
function query($sql)
{
    if($this->sqlid=mysql_query($sql,$this->linkid))
    { 
        return $this->sqlid;
    }
    else
    {
        $this->err_report($sql,mysql_error);
    }
    return false;
}

/*
 *返回结果集中行的数量
 *
 */
function num_rows($sql_id="")
{
    if(!$sql_id) $sql_id=$this->sqlid;
    return mysql_num_rows($sql_id);
}
/*
 *返回结果集中字段的数目
 *
 */
function num_field($sql_id="")
{
    if(!$sql_id) $sql_id=$this->sqlid;
    return mysql_num_fields($sql_id);//函数返回结果集中字段的数目
}

/*
 *
 *功能:返回结果集中取得一行作为关联数组,或数字数组
 * @$sql_id-->   mysql_query()执行之后的资源集
 */
function fetch_row_array($sql_id="")
{
    if(!$sql_id) $sql_id=$this->sqlid;
    if($this->record=mysql_fetch_array($sql_id))    
        return $this->record;
    else return false;
}

/*
 *
 *返回结果集合中以$name为下标的元素
 */
function row_array_index($name)
{
    if($this->record[$name]) 
    return $this->record[$name];
    else return false;
}

/*
 *关闭mysql服务器链接资源
 *
 */
function close() {
    mysql_close($this->linkid);
}

/*
 *对表进行锁定操作
 *
 */
function lock($tblname,$op="WRITE")
{
    if(mysql_query("lock tables ".$tblname." ".$op)) return true; else return false;
}
/*
 *解锁表
 *
 */
function unlock()
{if(mysql_query("unlock tables")) return true; else return false;}

/*
 * 取得最近一次与 link_identifier 关联的
 *   INSERT
 *   UPDATE
 *   DELETE、
 * 查询所影响的记录行数。
 */
function affect_rows(){//ar用affect_rows进行替换
    return @mysql_affected_rows($this->linkid);
}
/*
 * 取得最近一次insert的记录的id
 * insert
 * 
 */
function insert_id() {//i_d替换成了 insert_id()
    return mysql_insert_id();
}

/*
 * 输出错误信息
 */
function err_report($sql,$err)
{
    echo "Mysql查询错误<br>";
    echo "查询语句：".$sql."<br>";
    echo "错误信息：".$err;
}
/****************************************类结束***************************/
}
?>
