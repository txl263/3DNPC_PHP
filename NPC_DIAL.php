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

while ($row = mysqli_fetch_array($result))
{
        echo "表名：".$row["Name"];
        echo "NPC名字：".$row["Name"];
        echo "</br>";
        $i++;
        $File_Save_name=$row["Name"];
    //echo $row[0]."</br>";
    $new_TableName="Table_".$row["EditorID"];
    //不检测，直接删除表然后新建
    $sql="drop table ".$new_TableName;
    $result_drop = mysqli_query($con,$sql);
    echo $sql;
    echo "</br>";
    //新建表 联合查询 左联合
    $sql="create table $new_TableName
    (SELECT '0' as StrList,
    `".$row["EditorID"]."`.`TOPIC TEXT` as Source,
    `3DNPC_english_chinese`.DescCN as DescCN,
    ".$row["EditorID"].".`ID`
    FROM
    ".$row["EditorID"]."  LEFT JOIN 3DNPC_english_chinese on ".$row["EditorID"].".`TOPIC TEXT`=`3DNPC_english_chinese`.Source
    where
    ".$row["EditorID"].".`TOPIC TEXT` is not null
    and ".$row["EditorID"].".`TOPIC TEXT` != ''
    and right(".$row["EditorID"].".TOPICINFO,8) != substring(".$row["EditorID"].".FILENAME,-10,8)
    )

    UNION

    (SELECT '0' as StrList,
    `".$row["EditorID"]."`.`PROMPT` as Source,
    `3DNPC_english_chinese`.DescCN as DescCN,
    ".$row["EditorID"].".`ID`
    FROM
    ".$row["EditorID"]."  LEFT JOIN 3DNPC_english_chinese on ".$row["EditorID"].".`PROMPT`=`3DNPC_english_chinese`.Source
    where
    ".$row["EditorID"].".`PROMPT` is not null
    and ".$row["EditorID"].".`PROMPT` != ''
    and right(".$row["EditorID"].".TOPICINFO,8) != substring(".$row["EditorID"].".FILENAME,-10,8)
    )

    UNION

    (SELECT '2' as StrList,
    `".$row["EditorID"]."`.`RESPONSE TEXT` as Source,
    `3DNPC_english_chinese`.DescCN as DescCN,
    ".$row["EditorID"].".`ID`
    FROM
    ".$row["EditorID"]."  LEFT JOIN 3DNPC_english_chinese on ".$row["EditorID"].".`RESPONSE TEXT`=`3DNPC_english_chinese`.Source
    where
    ".$row["EditorID"].".`RESPONSE TEXT` is not null
    and ".$row["EditorID"].".`RESPONSE TEXT` != ''
    and right(".$row["EditorID"].".TOPICINFO,8) != substring(".$row["EditorID"].".FILENAME,-10,8)
    )
    ";

    echo $sql;echo "</br>";
    $result_new = mysqli_query($con,$sql);
    //建立主键索引
    $sql="alter table ".$new_TableName." add iiid int auto_increment primary key";
    echo $sql;echo "</br>";
    $result_alter = mysqli_query($con,$sql);
    //给DescCN字段值为Null的赋值,值为Source字段的值
    $sql="UPDATE ".$new_TableName." SET `DescCN`=`Source` where `DescCN` is NULL";
    echo $sql;echo "</br>";
    $result_update = mysqli_query($con,$sql);

    //下面是导出为XML文件部分

    $sql="select * from ".$new_TableName." order by id";
    echo $sql;echo "</br>";
    $result_out=mysqli_query($con,$sql);
    if (!$result_out)
    {
        echo "DB Error, could open table " . $new_TableName. "\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    //创建XML部分
    $XML=new DOMDocument("1.0","utf-8");	// 实例化一个对象，并设置 XML 版本和编码
    $XML->formatOutput=true;			// 格式化输出，保留缩进
    $XML->preservaWhiteSpace=false;		// 不保留空格，这个是辅助格式化输出的

    $root=$XML->createElement("SSTXMLRessources");		// 创建根节点SSTXMLRessources，有且只能有一个
    $lang1=$XML->createElement("Params");	            // 创建一个子节点Params，这是方法一
    $lang11=$XML->createElement("Addon","3DNPC.esp");               // 为Params节点创建一个子节点Addon，这是方法一
    $lang12=$XML->createElement("Source","english");               // 为Params节点创建一个子节点Source，这是方法一
    $lang13=$XML->createElement("Dest","chinese");               // 为Params节点创建一个子节点Dest，这是方法一
    //$lang11->setAttribute("Addon","3DNPC.esp");
    //$lang1->setAttribute("Addon","3DNPC.esp");			// 设置子节点的属性
    $root->appendChild($lang1);                         // 添加子节点，不添加将不能显示 $lang1
    $lang1->appendChild($lang11);
    $lang1->appendChild($lang12);
    $lang1->appendChild($lang13);
    $lang2=$XML->createElement("Content");			// 创建一个子节点，这是方法二
    while ($row = mysqli_fetch_array($result_out))
    {
        $lang22=$XML->createElement("String");			// 创建一个子节点，这是方法二
        $lang22->setAttribute("List",$row["StrList"]);
        //$lang22->setAttribute("Partial","1");
        $lang222=$XML->createElement("Source",$row["Source"]);
        $lang223=$XML->createElement("Dest",$row["DescCN"]);
        $root->appendChild($lang2);                         // 添加子节点，不添加将不能显示 $lang1
        $lang2->appendChild($lang22);
        $lang22->appendChild($lang222);
        $lang22->appendChild($lang223);
        //echo $row["DescCN"]."</br>";
    }
    $XML->appendChild($root);				// 最重要的一步：将根节点添加到文档里面
    $XML->save("XML/".$File_Save_name.".xml");				// 保存 XML 文档，路径是相对路径
    echo "XML/".$File_Save_name.".xml";

    mysqli_free_result($result_new);
    mysqli_free_result($result_drop);
    mysqli_free_result($result_alter);
    mysqli_free_result($result_drop);

}

mysqli_free_result($result);
echo "END";
?>