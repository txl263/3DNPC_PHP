<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 14-3-27
 * Time: 下午3:13
 */
//error_reporting(E_ALL ^ E_DEPRECATED);

$con = mysqli_connect("localhost","root","access","3DNPC");
mysqli_query($con,"SET NAMES 'UTF8'");
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>