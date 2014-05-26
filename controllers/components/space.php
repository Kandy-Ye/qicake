<?php
class SpaceComponent extends Object {
	
	function spaceInfo(&$controller, $current_user, $space_user_id = 0) {
		$spaceInfo = array();
		$newPrizeNum = 0;
				
		if (($space_user_id == 0) || ($space_user_id == $current_user['id'])) {
			// 我的空间			
			$db =& ConnectionManager::getDataSource('default');
			if ($current_user['id'] != 0) {
				$sql = "SELECT count(`id`) AS `c` FROM `aggregation_prize_winners` WHERE `status`='CREATED' AND `user_id`=".$current_user['id'];
				$newPrizeNum = $db->query($sql);
				$newPrizeNum = $newPrizeNum[0][0]['c'];
			}	
		
			$spaceInfo = array(
				'id' => $current_user['id'],
				'name' => $current_user['name'],
				'avatar' => $current_user['avatar'],
				'avatar_big' => $current_user['avatar_big'],
				'level' => $current_user['level'],
				'exp' => $current_user['exp'],
				'point' => $current_user['point'],
			
				// 以下ledou不推荐使用，建议使用point
				// 因为乐客空间我的金豆栏目需要使用ledou，所以这里没有删除
				'ledou' => $current_user['point'],
				'newPrizeNum' => $newPrizeNum,
				'whois' => 'mine'
			);
		} else {
			// 某人的空间
			$controller -> loadModel('User');
			$user = $controller -> User -> read(false, $space_user_id);
			
			$spaceInfo = array(
				'id' => $user['User']['id'],
				'name' => $user['User']['name'],
				'avatar' => $user['User']['avatar'],
				'avatar_big' => $user['User']['avatar_big'],
				'level' => $user['User']['level'],
				'exp' => $user['User']['exp'],
				'point' => $user['User']['point'],
				'newPrizeNum' => $newPrizeNum,	
				'whois' => 'his'
			);
		}
		
		return $spaceInfo;
	}
	
}
?>