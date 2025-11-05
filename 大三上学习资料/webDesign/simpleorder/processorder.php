<?php
  // 获取表单提交的数据
  $appleqty = $_GET['appleqty'];
  $pearqty = $_GET['pearqty'];
  $orangeqty = $_GET['orangeqty'];
  
  define('APPLE_PRICE', 1);
  define('PEAR_PRICE', 2);
  define('ORANGE_PRICE', 0.5);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <title>订单结果</title>
</head>
<body>
<h1>网上水果店</h1>
<h2>订单结果</h2>
<?php
date_default_timezone_set('Asia/Shanghai');
echo '<p>订单接受时间： ';
echo date('Y年n月j日 H:i');
echo "</p>\n";

echo '<p>你的订单如下: </p>';

$totalqty = 0;
$totalqty = $appleqty + $pearqty + $orangeqty;
echo "<p>共 ".$totalqty. " 个水果：</p>\n";

if( $totalqty == 0) {
  echo '<p>你没有在前一页中订购任何物品～</p>';
} else {
  echo "<ul>\n";
  if ( $appleqty>0 )  echo "<li>".$appleqty." 个苹果</li>\n";
  if ( $pearqty>0 )   echo "<li>".$pearqty." 个梨子</li>\n";
  if ( $orangeqty>0 ) echo "<li>".$orangeqty." 个桔子</li>\n";
  echo "</ul>\n";
}

$totalamount = 0.00;

$totalamount = $appleqty * APPLE_PRICE
             + $pearqty * PEAR_PRICE
             + $orangeqty * ORANGE_PRICE;

echo "<p>总价: ￥".number_format($totalamount,2)."</p>\n";
?>
</body>
</html>
