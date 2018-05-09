<?php
require_once "inc/common.php";
require_once "inc/wxapi.php";
require_once "db/wx_app_info.php";

// GET参数检查
if (!isset($_GET['media_id']))
  exit('need media_id');

$media_id = $_GET['media_id'];
$appid = Config::WX_APPID;

// 取得微信临时素材
$ret = get_tmp_media($appid, $media_id);

$file_name = 'upload/'.$media_id;
file_put_contents($file_name, $ret);

$rtn_ary = array("media_url" => 'http://wx.fnying.com/' . $file_name);
$rtn_str = json_encode($rtn_ary);

if (isset($_GET['callback'])) {
  $callback = $_GET['callback'];
  exit("{$callback}({$rtn_str});");
} else {
  exit($rtn_str);
}
?>
