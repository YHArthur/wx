<?php
//======================================
// 函数: 取得微信投票信息
// 参数: $vote_id       投票ID
// 返回: 微信投票信息数组
// 说明:
//======================================
function get_wx_vote_main($vote_id)
{
  $db = new DB_WX();
  $sql = "SELECT * FROM wx_vote_main WHERE vote_id = {$vote_id}";
  $db->query($sql);
  $row = $db->fetchRow();
  return $row;
}

//======================================
// 函数: 取得微信投票总数
// 参数: 无
// 返回: 记录总数
//======================================
function get_wx_vote_main_total()
{
  $db = new DB_WX();
  $sql = "SELECT COUNT(vote_id) AS id_total FROM wx_vote_main";
  $total = $db->getField($sql, 'id_total');
  if ($total)
    return $total;
  return 0;
}

//======================================
// 函数: 取得微信投票列表
// 参数: $limit         记录条数
// 参数: $offset        记录偏移量
// 返回: 记录列表
//======================================
function get_wx_vote_main_list($limit, $offset)
{
  $db = new DB_WX();
  $sql = "SELECT * FROM wx_vote_main";
  $sql .= " ORDER BY vote_id DESC";
  $sql .= " limit {$offset},{$limit}";

  $db->query($sql);
  $rows = $db->fetchAll();
  return $rows;
}

//======================================
// 函数: 创建微信投票信息
// 参数: $data          信息数组
// 返回: true           创建成功
// 返回: false          创建失败
//======================================
function ins_wx_vote_main($data)
{
  // 创建时间
  $data['ctime'] = date('Y-m-d H:i:s');

  $db = new DB_WX();
  $sql = $db->sqlInsert("wx_vote_main", $data);
  $q_id = $db->query($sql);

  if ($q_id == 0)
    return false;
  return true;
}

//======================================
// 函数: 更新微信投票信息
// 参数: $data          信息数组
// 参数: $vote_id       投票ID
// 返回: true           更新成功
// 返回: false          更新失败
//======================================
function upd_wx_vote_main($data, $vote_id)
{
  $db = new DB_WX();
  $where = "vote_id = {$vote_id}";
  $sql = $db->sqlUpdate("wx_vote_main", $data, $where);
  $q_id = $db->query($sql);

  if ($q_id == 0)
    return false;
  return true;
}
?>
