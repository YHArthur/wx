<?php
class wxApi {
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }

  // 获得微信用户信息
  public function getUserInfo($code)
  {
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appId}&secret={$this->appSecret}&code={$code}&grant_type=authorization_code";
    $res = json_decode($this->httpGet($url));
    $user = array();
    if (!isset($res->openid))
      return $user;
    $access_token = $res->access_token;
    $openid = $res->openid;
    // 拉取用户信息
    $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
    $user = json_decode($this->httpGet($url), true);
    return $user;
  }

  // 获得微信JsApiTicket
  public function getJsApiTicket($accessToken) {
    $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$accessToken}";
    $res = json_decode($this->httpGet($url));
    if (!isset($res->ticket))
      return '';
    return $res->ticket;
  }

  // 获得微信基础AccessToken
  public function getAccessToken() {
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret={$this->appSecret}";
    $res = json_decode($this->httpGet($url));
    if (!isset($res->access_token))
      return '';
    return $res->access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__).'/cacert.pem');
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
  }

}
?>
