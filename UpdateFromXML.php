<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 14-3-27
 * Time: 下午2:58
 * 功能：导入XML
 */
header("Content-type: text/html; charset=utf-8");
?>


<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 14-3-27
 * Time: 下午2:58
 */
//error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php");//引入conn.php文件

// some code

mysqli_select_db($con,"3DNPC");
//$sql = "CREATE TABLE 3DNPC_english_chinese(PID INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(PID),StrList int(5), Source varchar(255),DescCN varchar(255),DialiageID varchar(255)) COLLATE=utf8_bin DEFAULT CHARSET=utf8";

// Execute query

//if (mysqli_query($con,$sql))
//{
//    echo "Table persons created successfully";
//}
//else
//{
//    echo "Error creating table: " . mysqli_error($con);
//}




// 首先要建一个DOMDocument对象
$xml = new DOMDocument();

// 加载Xml文件
$xml->load("hebing2014-12-09.XML");

// 获取所有的Row节点
$postDom = $xml->getElementsByTagName("String");

// 循环遍历Row标签
$i=0;
foreach($postDom as $post){

    //echo "Source: " .$post->getElementsByTagName("Source")->item(0)->nodeValue."<br/><br/>";
    //echo "Dest: " .$post->getElementsByTagName("Dest")->item(0)->nodeValue."<br/><br/>";
    $StringList=$postDom->item($i)->attributes->item(0)->nodeValue;
    $SouceIn=$post->getElementsByTagName("Source")->item(0)->nodeValue;
    $DescCNIn=$post->getElementsByTagName("Dest")->item(0)->nodeValue;
    //echo $SouceIn ."<br/><br/>" ;
    //echo $DescCNIn ."<br/><br/>" ;
/*
 * 在我们接收用户提交的数据时，为了数据的安全性我们需要使用 get_magic_quotes_gpc()
 * 函数来判断特殊字符的转义是否已经开启。如果这个选项为off（未开启），返回0，
 * 那么我们就必须调用addslashes 这个函数来为字符串增加转义。
 */
    if(! get_magic_quotes_gpc() )
    {
        $StringList=addslashes ($StringList);
        $SouceIn=addslashes ($SouceIn);
        $DescCNIn=addslashes ($DescCNIn);
        echo $SouceIn ."<br/><br/>" ;
        //echo $DescCNIn ."<br/><br/>" ;

    }

    else
    {

    }

    $sql="SELECT * FROM 3DNPC_english_chinese WHERE Source='".$SouceIn."'";
    echo $sql;echo "</br>";
    $result = mysqli_query($con,$sql);
    if (!$result)
    {
        $sql ="INSERT INTO 3DNPC_english_chinese (StrList,Source,DescCN,DialiageID) VALUES (". " '$StringList', '$SouceIn' , '$DescCNIn' ,$i)";
        echo $sql."<br/><br/>" ;
        $result_insert=mysqli_query($con,$sql);
        if (!$result_insert)
        {
            //echo "Insert record in Table 3DNPC_english_chinese successfully";
        }
        else
        {
            echo "Error insert: " . mysqli_error($con);
        }
        mysqli_free_result($result_insert);
    }

        //$sql ="INSERT INTO 3DNPC_english_chinese (StrList,Source,DescCN,DialiageID) VALUES (". " '$StringList', '$SouceIn' , '$DescCNIn' ,$i)";
        $sql ="Update 3DNPC_english_chinese set DescCN='".$DescCNIn."' where Source='".$SouceIn."' and SescCN !='".$DescCNIn."'";
        echo $i++."<br/><br/>";
        echo $sql."<br/><br/>" ;
        $result_update=mysqli_query($con,$sql);
        if (!$result_update)
        {
            //echo "Update Table 3DNPC_english_chinese successfully";
        }
        else
        {
            echo "Error update table: " . mysqli_error($con);
        }
    mysqli_free_result($result_update);

//$result = mysqli_query($con,"SELECT * FROM 3DNPC_english_chinese");


}

mysqli_close($con);
echo "END";
?>

