<?php
require_once "inc/common.php";

php_begin(Config::INFO_LEVEL);

Session_start();
// 未设置TOKEN和跳转URL
if (!isset($_GET['token']) || !isset($_GET['url']))
  exit('need token and url');

$_SESSION["token"] = $_GET['token'];
$_SESSION["url"] = $_GET['url'];
$_SESSION["state"] = rand(10000,100000);
$state = $_SESSION["state"];

$user_agent = $_SERVER['HTTP_USER_AGENT'];
$redirect_uri = urlencode('http://wx.fnying.com/login_callback.php');

if (strpos($user_agent, 'MicroMessenger') === false) {
  // 非微信浏览器，网站登录
  $appid = Config::WEB_APPID;
  $url = "https://open.weixin.qq.com/connect/qrconnect?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_login&state={$state}";
} else {
  // 微信浏览器，微信登录
  $appid = Config::WX_APPID;
  $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
}
$_SESSION["appid"] = $appid;
// 重定向
Header("Location: $url");
?>
