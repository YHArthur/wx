<?php
require_once "inc/common.php";
require_once "db/wx_user_info.php";

// GET参数检查
if (!isset($_GET['wxid']))
  exit('need wxid');

if (!isset($_GET['unionid']))
  exit('need unionid');

$wxid = $_GET['wxid'];
$unionid = $_GET['unionid'];

// 取得微信用户信息
$row = get_wx_user_info($wxid, $unionid);
$rtn_str = json_encode($row);

if (isset($_GET['callback'])) {
  $callback = $_GET['callback'];
  exit("{$callback}({$rtn_str});");
} else {
  exit($rtn_str);
}
?>
