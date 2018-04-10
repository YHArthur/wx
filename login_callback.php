<?php
require_once "inc/common.php";
require_once "inc/wxapi.php";
require_once "db/wx_app_info.php";
require_once "db/wx_user_info.php";

php_begin(Config::INFO_LEVEL);

// GET参数检查
if (empty($_GET['state']))
  exit('need state');
if (empty($_GET['code']))
  exit('access forbidden');

Session_start();

// state参数检查
if ($_GET['state'] != $_SESSION["state"])
  exit('wrong parameter');

// SESSION参数检查
if (!isset($_SESSION["appid"]))
  exit('miss session');

// 微信返回CODE取得
$code = $_GET['code'];
$appid = $_SESSION["appid"];

// 获取微信用户信息
$user = get_user_info($appid, $code);
// 微信用户信息取得失败
if (!isset($user['openid']))
  exit('get wx user info failed');

$openid = $user['openid'];
// 用户特权信息
$user['privilege'] = json_encode($user['privilege']);

// 判定微信用户是否存在
if (exist_wx_user_info($openid)) {
  $ret = upd_wx_user_info($user, $openid);
} else {
  $ret = ins_wx_user_info($user);
}

// 微信统一标识
$unionid = $user['unionid'];

// 微信用户信息保存处理失败
if (!$ret)
  exit('save wx user info failed');

// 设置了回调地址和微信统一标识
if (isset($_SESSION["url"]) && !empty($unionid)) {
  $url = $_SESSION["url"];
  $par = "id={$unionid}";
  // 设置了token
  if (isset($_SESSION["token"])) {
    $token = $_SESSION["token"];
    $par .= "&token={$token}";
  }
  // 回调地址包含其他参数
  if (strpos($url, '?') !== false) {
    $url .= "&{$par}";
  } else {
    $url .= "?{$par}";
  }
  Header("Location: {$url}");
} else {
  // 重定向至首页
  Header("Location: index.php");
}
?>
