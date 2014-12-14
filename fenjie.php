<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 14-3-27
 * Time: 下午2:58
 */
header("Content-type: text/html; charset=utf-8");
?>
<?php

include("conn.php");//引入conn.php文件
//mysqli_select_db($con,"3DNPC");

//$result=mysqli_query($con,'show tables');

?>
<html>
<head>
    <link rel="stylesheet" href="/css/encryptor.css">
    <script>
        function wsug(e, str){
            var oThis = arguments.callee;
            if(!str) {
                oThis.sug.style.visibility = 'hidden';
                document.onmousemove = null;
                return;
            }
            if(!oThis.sug){
                var div = document.createElement('div'), css = 'top:0; left:0; position:absolute; z-index:100; visibility:hidden';
                div.style.cssText = css;
                div.setAttribute('style',css);
                var sug = document.createElement('div'), css= 'font:normal 12px/16px "宋体"; white-space:nowrap; color:#666; padding:3px; position:absolute; left:0; top:0; z-index:10; background:#f9fdfd; border:1px solid #0aa';
                sug.style.cssText = css;
                sug.setAttribute('style',css);
                var dr = document.createElement('div'), css = 'position:absolute; top:3px; left:3px; background:#333; filter:alpha(opacity=50); opacity:0.5; z-index:9';
                dr.style.cssText = css;
                dr.setAttribute('style',css);
                var ifr = document.createElement('iframe'), css='position:absolute; left:0; top:0; z-index:8; filter:alpha(opacity=0); opacity:0';
                ifr.style.cssText = css;
                ifr.setAttribute('style',css);
                div.appendChild(ifr);
                div.appendChild(dr);
                div.appendChild(sug);
                div.sug = sug;
                document.body.appendChild(div);
                oThis.sug = div;
                oThis.dr = dr;
                oThis.ifr = ifr;
                div = dr = ifr = sug = null;
            }
            var e = e || window.event, obj = oThis.sug, dr = oThis.dr, ifr = oThis.ifr;
            obj.sug.innerHTML = str;

            var w = obj.sug.offsetWidth, h = obj.sug.offsetHeight, dw = document.documentElement.clientWidth||document.body.clientWidth; dh = document.documentElement.clientHeight || document.body.clientHeight;
            var st = document.documentElement.scrollTop || document.body.scrollTop, sl = document.documentElement.scrollLeft || document.body.scrollLeft;
            var left = e.clientX +sl +17 + w < dw + sl  &&  e.clientX + sl + 15 || e.clientX +sl-8 - w, top = e.clientY + st +17 + h < dh + st  &&  e.clientY + st + 17 || e.clientY + st - 5 - h;
            obj.style.left = left+ 10 + 'px';
            obj.style.top = top + 10 + 'px';
            dr.style.width = w + 'px';
            dr.style.height = h + 'px';
            ifr.style.width = w + 3 + 'px';
            ifr.style.height = h + 3 + 'px';
            obj.style.visibility = 'visible';
            document.onmousemove = function(e){
                var e = e || window.event, st = document.documentElement.scrollTop || document.body.scrollTop, sl = document.documentElement.scrollLeft || document.body.scrollLeft;
                var left = e.clientX +sl +17 + w < dw + sl  &&  e.clientX + sl + 15 || e.clientX +sl-8 - w, top = e.clientY + st +17 + h < dh + st  &&  e.clientY + st + 17 || e.clientY + st - 5 - h;
                obj.style.left = left + 'px';
                obj.style.top = top + 'px';
            }
        }</script>
</head>
<body>
<p align="center"><img src="/img/110055q2bog558o5czy8yq.jpg" width="800" height="400"></p>
<p>
<div class="menu">
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Home</a> -
    <a href="<?php echo $_SERVER['PHP_SELF'].'?op=record'; ?>">Record</a> -
    <a href=" <?php //echo $_SERVER['PHP_SELF'].'?op=about'; ?> ">About </a>
</div>
<div class="main"  style="display:none">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="input" size="67"><br / >
        <input type="submit" value="New" name="op">
        <input type="submit" value="Load" name="op">
        <input type="submit" value="Encode" name="op">
        <input type="submit" value="Decode" name="op">
        <input type="submit" value="Clean" name="op">
    </form>


</div>
<div class="display" align="right">
    <?php
    //include "encryptdemo5.php";
    if (isset($_GET['submit'])&& $_GET['submit']){
        //echo $_GET['fName'];//执行你的代码，存储到mysql
    }
    ?>
    <form class="altrowstable" action="" align="left">

         <?php
            /**$my_file = file_get_contents("myfilename");
            echo $my_file;
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

                if (isset($_POST["select"]) && urlencode($row["Name"])==$_POST["select"])
                {
                    echo "<option value=". $row["Name"]. " selected>". $row["Name"] . "</option>";
                    $i++;
                }
                else
                {
                    echo "<option value=". urlencode($row["Name"]). ">". $row["Name"] . "</option>";
                    $i++;
                }
            //echo $row[0]."</br>";


            mysqli_free_result($result);
             */
         
                     ?>

            <input class="submit" type="file" name="fName">
            <input type="submit" name="submit" value="提交">

    </form>
</div>

<style type="text/css">
    <!--

    select {
        position:relative;
        left:-2px;
        top:-2px;
        font-size:12px;
        width:125px;
        line-height:18px;border:0px;
        color:#909993;
    }
    -->
</style>
<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">
    function altRows(id){
        if(document.getElementsByTagName){

            var table = document.getElementById(id);
            var rows = table.getElementsByTagName("tr");

            for(i = 0; i < rows.length; i++){
                if(i % 2 == 0){
                    rows[i].className = "evenrowcolor";
                }else{
                    rows[i].className = "oddrowcolor";
                }
            }
        }
    }
    window.onload=function(){
        altRows('alternatecolor');
    }
</script>

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
    .altrowstable {
        font-family: verdana,arial,sans-serif;
        width:800px;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #a9c6c9;
        border-collapse: collapse;
    }
    .altrowstable th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #a9c6c9;
    }
    .altrowstable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #a9c6c9;
    }
    .oddrowcolor{
        background-color:#d4e3e5;
    }
    .evenrowcolor{
        background-color:#c3dde0;
    }
</style>


<!-- Table goes in the document BODY -->
</p>
<!--  The table code can be found here: http://www.textfixer/tutorials/css-tables.php#css-table03 -->

<div class="display" align="right">
    <?php
    if (isset($_GET['submit'])&& $_GET['submit']){
        ?>
        <form  class="altrowstable" action="XMLOutput.php" target="_blank" method="post" align="left">
            <input  align="left" class="submit" type="submit" name="Submit2" value="点击分解XML文件">
        </form>
        <table class="altrowstable" id="alternatecolor" align="center">
            <tr><th colspan="3" align="center">
                    <?php
                       echo $_GET['fName'];
             //得到文件名

                    ?>

                </th></tr>
            <?php
            $xml = new DOMDocument();
            // 加载Xml文件
            $filename=$_GET['fName'];
            //echo $filename;
            $xml->load("$filename");
            // 获取所有的Row节点
            $postDom = $xml->getElementsByTagName("String");
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
                    //echo $SouceIn ."<br/><br/>" ;
                    //echo $DescCNIn ."<br/><br/>" ;
                    $XMLOutPut=new DOMDocument("1.0","utf-8");	// 实例化一个对象，并设置 XML 版本和编码
                    $XMLOutPut->formatOutput=true;			// 格式化输出，保留缩进
                    $XMLOutPut->preservaWhiteSpace=false;		// 不保留空格，这个是辅助格式化输出的
                    $root=$XMLOutPut->createElement("SSTXMLRessources");		// 创建根节点SSTXMLRessources，有且只能有一个
                    $lang1=$XMLOutPut->createElement("Params");	            // 创建一个子节点Params，这是方法一
                    $lang11=$XMLOutPut->createElement("Addon","3DNPC.esp");               // 为Params节点创建一个子节点Addon，这是方法一
                    $lang12=$XMLOutPut->createElement("Source","english");               // 为Params节点创建一个子节点Source，这是方法一
                    $lang13=$XMLOutPut->createElement("Dest","chinese");               // 为Params节点创建一个子节点Dest，这是方法一
                    $root->appendChild($lang1);                         // 添加子节点，不添加将不能显示 $lang1
                    $lang1->appendChild($lang11);
                    $lang1->appendChild($lang12);
                    $lang1->appendChild($lang13);


                    $lang2=$XMLOutPut->createElement("Content");			// 创建一个子节点，这是方法二
                    $lang22=$XMLOutPut->createElement("String");			// 创建一个子节点，这是方法二
                    $lang22->setAttribute("List","2");
                    $lang22->setAttribute("Partial","1");
                    $lang222=$XMLOutPut->createElement("Source",$SouceIn);
                    $lang223=$XMLOutPut->createElement("Dest",$DescCNIn);
                    $root->appendChild($lang2);                         // 添加子节点，不添加将不能显示 $lang1
                    $lang2->appendChild($lang22);
                    $lang22->appendChild($lang222);
                    $lang22->appendChild($lang223);

                    $XMLOutPut->appendChild($root);				// 最重要的一步：将根节点添加到文档里面
                    $XMLOutPut->save($filename.$i.".xml");				// 保存 XML 文档，路径是相对路径
                    $i=$i+1;
                }


                ?>
                <tr>
                    <th>Source</th>
                    <td onMouseOver="wsug(event, '<?php echo $SouceIn; ?>')" onMouseOut="wsug(event, 0)" ><?php echo $SouceIn;?></td>
                </tr>
                <tr>
                    <th>Desc</th>
                    <td><?php echo $DescCNIn;?></td>
                </tr>

            <?php
            }
            }
            ?>
        </table>

</div>

</div>
</body>
</html>
<?php
mysqli_close($con);
?>
