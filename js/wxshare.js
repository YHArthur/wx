$(function () {
  
  // 分享标题
  var ShareTitle = '风赢科技';
  // 分享描述
  var ShareDesc = '风行天下，赢在中国';
  // 分享链接
  var ShareLink = window.location.href;
  // 分享图标
  var ShareimgUrl = 'http://www.fnying.com/wx/img/share_feng.jpg';
  
  // 微信配置启动
  wx_config();

  wx.ready(function() {
      wx.onMenuShareTimeline({
          title: ShareTitle,
          desc: ShareDesc,
          link: ShareLink,
          imgUrl: ShareimgUrl
      });

  });


});

