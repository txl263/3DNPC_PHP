<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 14-3-27
 * Time: 下午2:58
 */
header("Content-type: text/html; charset=utf-8");

include("conn.php");//引入conn.php文件
//mysqli_select_db($con,"3DNPC");
mysqli_select_db($con,"3DNPC");
?>

<?php
//$_POST["NPCName"]='Jeerah-Nur';
//$_POST["NPCName"]="Viranya";

if (isset($_POST["NPCName"]))
{

//echo $_POST["NPCName"]."</br>"; 
$EdirotID=urldecode($_POST["NPCName"]);

$sql="SELECT `FormID`, `EditorID`,`Name`, `Chk` FROM `3DNPC` WHERE `Name`=\"$EdirotID\" ";
//echo $sql;
$result = mysqli_query($con,$sql);
if (!$result)
    {
        echo "DB Error, could open table " . $BiaoMing. "\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
	$row = mysqli_fetch_array($result);
	$BiaoMing=$row["EditorID"];
	//echo $BiaoMing;
	/*$sql="SELECT `3DNPC_english_chinese`.DescCN, `3DNPC_english_chinese`.Source, `3DNPC_english_chinese`.StrList, ".$BiaoMing."
	    .TOPIC, $BiaoMing.EMOTION FROM $BiaoMing,3DNPC_english_chinese
	    where `3DNPC_english_chinese`.Source=".$BiaoMing.".`RESPONSE TEXT` and " .$BiaoMing. ".`RESPONSE TEXT` is not null and " .$BiaoMing. ".`RESPONSE TEXT` != '' " ;
    */
    $sql="SELECT `3DNPC_english_chinese`.DescCN, `3DNPC_english_chinese`.Source, `3DNPC_english_chinese`.StrList FROM $BiaoMing,3DNPC_english_chinese
	    where
	        (`3DNPC_english_chinese`.Source=".$BiaoMing.".`TOPIC TEXT` and " .$BiaoMing. ".`TOPIC TEXT` is not null   and " .$BiaoMing. ".`TOPIC TEXT` != '')
	        or (`3DNPC_english_chinese`.Source=".$BiaoMing.".PROMPT and " .$BiaoMing. ".PROMPT is not null   and " .$BiaoMing. ".PROMPT != '')
	        or(`3DNPC_english_chinese`.Source=".$BiaoMing.".`RESPONSE TEXT` and " .$BiaoMing. ".`RESPONSE TEXT` is not null   and " .$BiaoMing. ".`RESPONSE TEXT` != '')
	        " ;

	echo $sql;


    $result = mysqli_query($con,$sql);
	if (!$result)
    {
        echo "DB Error, could open table " . $BiaoMing. "\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
	
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
	
	while ($row = mysqli_fetch_array($result))
	{


		$lang22=$XML->createElement("String");			// 创建一个子节点，这是方法二
		$lang22->setAttribute("List",$row["StrList"]);
		$lang22->setAttribute("Partial","1");
		$lang222=$XML->createElement("Source",$row["Source"]);
        $lang223=$XML->createElement("Dest",$row["DescCN"]);
		$root->appendChild($lang2);                         // 添加子节点，不添加将不能显示 $lang1
		$lang2->appendChild($lang22);
		$lang22->appendChild($lang222);
		$lang22->appendChild($lang223);
		//echo $row["DescCN"]."</br>";




	}

      



$XML->appendChild($root);				// 最重要的一步：将根节点添加到文档里面

$XML->save($EdirotID.".xml");				// 保存 XML 文档，路径是相对路径

}


mysqli_close($con);
?>
<meta http-equiv="refresh" content="0;URL=<?php echo $EdirotID?>.xml" />