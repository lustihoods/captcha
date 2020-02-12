<?php
require_once 'vendor/autoload.php';
//use lustihoods\captcha;
//使用方法
$captcha  = new lustihoods\captcha\Captcha(['width'=>140,'height'=>70,'len'=>4]);
 
$captcha->entry();

//$index = new lustihoods\captcha\index();
//echo $index->index();

