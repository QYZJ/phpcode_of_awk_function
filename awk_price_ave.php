<?php
error_reporting(3);
/**
 * Created by PhpStorm.
 * User: zhangquanzhi
 * Date: 15-11-17
 * Time: 下午5:10
 */
header("Content-type: text/html; charset=utf-8");
$countfile="log.txt";  //设置保存数据的文件
$fp = fopen($countfile,"r") or die("Unable to open file!");
$res=array();
$cnt=array();
while(!feof($fp))
{
    $str= fgets($fp);
    $a=explode("\t",$str);
    if (!preg_match("/[\x7f-\xff]/",$a[3])) {
        $a[3]=strtolower($a[3]);
    }
    if (array_key_exists($a[3],$cnt)){

        $cnt[$a[3]]=array("amount"=>$a[4]+$cnt[$a[3]]["amount"],"times"=>1+$cnt[$a[3]]["times"]);
    }else{
        $cnt[$a[3]]=array("amount"=>floatval($a[4]),"times"=>intval(1));  }
}
foreach($cnt as $k=>$v){
    echo $k."&nbsp;".$v["amount"]/$v["times"]."<br>";
}
fclose($fp);
?>