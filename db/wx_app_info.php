<?php
//======================================
// 函数: 获取微信用户信息
// 参数: $appid        APPID
// 参数: $code         用户授权code
// 返回: 用户信息数组
// 返回: 异常返回空数组
//======================================
function get_user_info($appid, $code)
{
  $db = new DB_WX();
  $data = array();
  
  // 取得APPID对应的微信ID和凭证密钥
  $sql = "SELECT wxid, secret FROM wx_app_info WHERE appid = '{$appid}'";
  $db->query($sql);
  $row = $db->fetchRow();
  if (!($row))
    return $data;
  // 凭证密钥
  $secret = $row['secret'];
  // 通过微信API获得微信用户信息
  $api = new wxApi($appid, $secret);
  $data = $api->getUserInfo($code);
  // 微信ID
  $data['wxid'] = $row['wxid'];
  return $data;
}

//======================================
// 函数: 获取微信基础AccessToken
// 参数: $appid         APPID
// 返回: 微信基础AccessToken
// 返回: 异常返回空字符串
//======================================
function get_access_token($appid)
{
  $db = new DB_WX();

  $sql = "SELECT * FROM wx_app_info WHERE appid = '{$appid}'";
  $db->query($sql);
  $row = $db->fetchRow();
  if (!$row)
    return '';
  // Token过期时间
  $token_expire_time = $row['token_expire_time'];
  // AccessToken未过期
  if ($token_expire_time >= time())
    return $row['token'];

  // AccessToken已过期，重新取得
  $secret = $row['secret'];
  $api = new wxApi($appid, $secret);
  $token = $api->getAccessToken();
  // 成功取得AccessToken
  if (!empty($token)) {
    // 计算新的Token过期时间
    $token_expire_time = time() + 7000;
    // 更新AccessToken和Token过期时间
    $sql = "UPDATE wx_app_info SET token = '{$token}', token_expire_time = {$token_expire_time} WHERE appid = '{$appid}'";
    $db->query($sql);
  }
  return $token;
}

//======================================
// 函数: 获取微信JsapiTicket
// 参数: $appid         APPID
// 返回: JsapiTicket
// 返回: 异常返回空字符串
//======================================
function get_jsapi_ticket($appid)
{
  $db = new DB_WX();

  $sql = "SELECT * FROM wx_app_info WHERE appid = '{$appid}'";
  $db->query($sql);
  $row = $db->fetchRow();
  if (!$row)
    return '';
  // Ticket过期时间
  $ticket_expire_time = $row['ticket_expire_time'];
  // JsapiTicket未过期
  if ($ticket_expire_time >= time())
    return $row['ticket'];

  // 凭证密钥
  $secret = $row['secret'];
  // JsapiTicket已过期，先取得AccessToken
  $token = get_access_token($appid);
  // 成功取得AccessToken
  if (!empty($token)) {
    // 取得JsapiTicket
    $api = new wxApi($appid, $secret);
    $ticket = $api->getJsApiTicket($token);
    // 成功取得AccessToken
    if (!empty($ticket)) {
      // 计算新的Ticket过期时间
      $ticket_expire_time = time() + 7000;
      // 更新AccessToken和Token过期时间
      $sql = "UPDATE wx_app_info SET ticket = '{$ticket}', ticket_expire_time = {$ticket_expire_time} WHERE appid = '{$appid}'";
      $db->query($sql);
    }
  }
  return $ticket;
}
?>
