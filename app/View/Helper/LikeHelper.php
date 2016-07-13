<?php

App::uses('AppHelper', 'View/Helper', 'Competition');

class LikeHelper extends AppHelper {
    public function getVotes($member_id) {
    	App::import("Model", "Like");  
		$model = new Like();  
		$count = $model->find("count", array(
			'conditions' => array('Like.member_id' => $member_id)
		));
		return $count;
    	// $count = $this->Page->query("SELECT * FROM news");
    	// $this->Visit->find('count', array(
     //         'conditions' => array('Visit.news_id' => $id)
     //     ));
    }
}