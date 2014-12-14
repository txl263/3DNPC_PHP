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
    ?>

    <form class="altrowstable" action="" method="post" align="left">
        按NPC名字查询对话<select class="option" name="select" size="1" width="10" align="left">
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

            ?>
            <input class="submit" type="submit" name="Submit" value="点击查询对话" onsubmit="document.getElementById('myButton').disabled=true;">

        </select>
    </form>


    <?php
    //echo $_GET["select"];

    //echo "</br>".$i;
    /*mysqli_select_db($con,"3DNPC");
    $sql="SELECT `FormID`, `Name`, `Chk` FROM `3DNPC` WHERE `Chk`=1";
    echo $sql;
    $result = mysqli_query($con,$sql);
    $i=1;
    if(!$result)
    {
    echo 'Cannot run query';
    exit;
    }

    while ($row = mysqli_fetch_array($result)) {

        echo  $row["Name"] ;
        echo "</br>".$i++;
    }
    */
    ?>
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
    if (isset($_POST["select"])) {
        ?>
        <form  class="altrowstable" action="XMLOutput.php" target="_blank" method="post" align="left">
            已按Topic(话题)排序
            <input align="left" class="submit" type="hidden" name="NPCName" value="<?php echo urldecode($_POST["select"]); ?>">
            <input  align="left" class="submit" type="submit" name="Submit2" value="点击下载XML文件">
        </form>
        <table class="altrowstable" id="alternatecolor" align="center">
            <tr><th colspan="3" align="center">
                    <?php
                    echo urldecode($_POST["select"]);
                    ?>

                </th></tr>
            <?php
            $EdirotID=urldecode($_POST["select"]);
            $sql="SELECT `FormID`, `EditorID`,`Name`, `Chk` FROM `3DNPC` WHERE `Name`=\"$EdirotID\" ";
            //echo $sql;
            $result = mysqli_query($con,$sql);
            if (!$result)
            {
                echo "DB Error, could open table " . $BiaoMing. "\n";
                echo $sql;
                echo 'MySQL Error: ' . mysql_error();
                exit;
            }
            $row = mysqli_fetch_array($result);
            $BiaoMing=$row["EditorID"];
            $sql="SELECT
                `3DNPC_english_chinese`.DescCN,
                `3DNPC_english_chinese`.Source,
                `3DNPC_english_chinese`.StrList,
                $BiaoMing.TOPIC,
                $BiaoMing.EMOTION,
                $BiaoMing.QUEST,
                $BiaoMing.`TOPIC TEXT`,
                $BiaoMing.`PROMPT`,
                $BiaoMing.`RESPONSE TEXT`,
                $BiaoMing.`TYPE`,
                $BiaoMing.`SUBTYPE`
                FROM
                $BiaoMing,3DNPC_english_chinese
                where
                `3DNPC_english_chinese`.Source=$BiaoMing.`RESPONSE TEXT`
                and " .$BiaoMing. ".`RESPONSE TEXT` is not null
                and " .$BiaoMing. ".`RESPONSE TEXT` != ''
                ORDER BY $BiaoMing.TOPIC" ;
            echo $sql;
            $result = mysqli_query($con,$sql);
            if (!$result)
            {
                echo "DB Error, could open table " . $BiaoMing. "\n";
                echo 'MySQL Error: ' . mysql_error();
                exit;
            }
            while ($row = mysqli_fetch_array($result))
            {
                ?>
                <tr>
                    <th>Source</th>
                    <td onMouseOver="wsug(event, '<?php echo "Quest:".$row["QUEST"]
                        ."</br>Topic话题:".$row["TOPIC"]
                        ."</br>Topic内容:".$row["TOPIC TEXT"]
                        ."</br>TYPE:".$row["TYPE"]
                        ."</br>SUBTYPE:".$row["SUBTYPE"]
                        ."</br> Emotion:".$row["EMOTION"]; ?>')" onMouseOut="wsug(event, 0)" ><?php echo $row["Source"];?></td>
                </tr>
                <tr>
                    <th>Desc</th>
                    <td><?php echo $row["DescCN"];?></td>
                </tr>
                <?php
                ?>

            <?php
            }
            ?>
        </table>
    <?php
    }
    else
    ?>

</div>

</div>
</body>
</html>
<?php
mysqli_close($con);
?>
