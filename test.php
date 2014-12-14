<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 2014-12-08 05:14:19
 * Time: 下午2:58
 */
header("Content-type: text/html; charset=utf-8");

include("conn.php");//引入conn.php文件
//mysqli_select_db($con,"3DNPC");
mysqli_select_db($con,"3DNPC");
?>

<?php
mysqli_select_db($con,"3DNPC");
$sql="SELECT `FormID`, `EditorID`,`Name`, `Chk` FROM `3DNPC` WHERE `Chk`=1";
//echo $sql;
$result = mysqli_query($con,$sql);
$i=1;
if (!$result)
{
    echo "DB Error, could not open table 3DNPC\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
$i=1;
while ($row = mysqli_fetch_array($result))
{
    echo "表名：".$row["Name"]."  ";
    echo "NPC名字：".$row["Name"];
    echo "</br>";
    echo $i++."<br/><br/>";

}

mysqli_free_result($result);
?>