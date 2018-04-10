<?php
//======================================
// 函数: 取得微信用户信息
// 参数: $wxid          微信ID
// 参数: $unionid       微信统一标识
// 返回: 微信用户信息数组
// 说明:
//======================================
function get_wx_user_info($wxid, $unionid)
{
  $db = new DB_WX();
  $sql = "SELECT * FROM wx_user_info WHERE wxid = {$wxid} AND unionid = '{$unionid}'";
  $db->query($sql);
  $row = $db->fetchRow();
  return $row;
}

//======================================
// 函数: 判定微信用户是否存在
// 参数: $openid        微信OPENID
// 返回: true           存在
// 返回: false          不存在
// 说明:
//======================================
function exist_wx_user_info($openid)
{
  $db = new DB_WX();
  $sql = "SELECT openid FROM wx_user_info WHERE openid = '{$openid}'";
  $db->query($sql);
  $rds = $db->recordCount();
  if ($rds != 0)
    return true;
  return false;
}

//======================================
// 函数: 创建微信用户信息
// 参数: $data          信息数组
// 返回: true           创建成功
// 返回: false          创建失败
//======================================
function ins_wx_user_info($data)
{
  // 更新时间
  $data['utime'] = time();
  // 提交时间
  $data['ctime'] = date('Y-m-d H:i:s');

  $db = new DB_WX();

  $sql = $db->sqlInsert("wx_user_info", $data);
  $q_id = $db->query($sql);

  if ($q_id == 0)
    return false;
  return true;
}

//======================================
// 函数: 更新微信用户信息
// 参数: $data          信息数组
// 参数: $openid        微信唯一标识
// 返回: true           更新成功
// 返回: false          更新失败
//======================================
function upd_wx_user_info($data, $openid)
{
  // 更新时间
  $data['utime'] = time();

  $db = new DB_WX();

  $where = "openid = '{$openid}'";
  $sql = $db->sqlUpdate("wx_user_info", $data, $where);
  $q_id = $db->query($sql);

  if ($q_id == 0)
    return false;
  return true;
}
?>
