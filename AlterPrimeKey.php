<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 14-3-29
 * Time: 上午4:31
 * 给所有表加入主键
 */
header("Content-type: text/html; charset=utf-8");
include("conn.php");//引入conn.php文件
//mysqli_select_db($con,"3DNPC");

$result=mysqli_query($con,'show tables');

  if (!$result)
  {
      echo "DB Error, could not list tables\n";
      echo 'MySQL Error: ' . mysql_error();
      exit;
  }

    while($row = mysqli_fetch_array($result))
    {
        //alter table tabelname add new_field_id int(5) unsigned default 0 not null auto_increment ,add primary key (new_field_id);
        $sql="Alter table $row[0] add id int(5) unsigned  not null auto_increment ,add primary key (id)";
        echo $sql;
        mysqli_query($con,$sql);
    }


//Alter table tb add primary key(id)；
//mysqli_query($con,"UPDATE 3DNPC SET Chk = '0' WHERE EditorID = '$EditorID' ")

mysqli_close($con);
?>