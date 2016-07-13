<?php 

class CompetitionsController extends AppController{
	public $uses = array('Competition', 'Member', 'News', 'Gallery', 'Like');

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index(){
		// $this->Competition->locale = false;
		$this->Competition->locale = 'ru';
		$data = $this->Competition->find('all', array(
			'order' => array('id' => 'ASC')
		));
		$title_for_layout = __('Конкурсы');
		$this->set(compact('data', 'title_for_layout'));
	}

	public function admin_index(){
		$this->Competition->locale = 'ru';
		
		$data = $this->Competition->find('all');
		
		
		// debug($data);
		$this->set(compact('data'));
	}

	protected function _status($id, $status){
		// debug($status);
		if($status == 1){
			$res = $this->Member->updateAll(
			    array('Member.active' => 1),
			    array('Member.id =' => $id)
			);
		}else{
			$res = $this->Member->updateAll(
			    array('Member.active' => 0),
			    array('Member.id =' => $id)
			);
		}
		return $res;
	}

	public function admin_members($id){
		if(is_null($id) || !(int)$id || !$this->Competition->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		$data = $this->Competition->findById($id);
		$members = $data['Member'];
		if($this->request->is('post')){
			// $anons = $this->request->data['News']['anons'];
			// $id = $this->request->data['News']['news_id'];
			$member_id = $this->request->data['member_id'];
			$status = $this->request->data['status'];
			// die;

			// debug($news_id);
			$setStatus = $this->_status($member_id,  $status);
			// $setAnons = $this->_anons($news_id, $anons);
			if($setStatus){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
		// debug($data);
		$this->set(compact('members'));
	}

	public function admin_add(){
		if($this->request->is('post')){
			$this->Competition->create();
			$data = $this->request->data['Competition'];

			 if(!$data['img']['name']){
			 	unset($data['img']);
			}
			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Competition->locale = 'kz';
			}else{
				$this->Competition->locale = 'ru';
			}
			if($this->Competition->save($data)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
	}

	public function admin_edit($id){
		
		if(is_null($id) || !(int)$id || !$this->Competition->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		$data = $this->Competition->findById($id);
		if(!$id){
			throw new NotFoundException('Такой страницы нет...');
		}
		if($this->request->is(array('post', 'put'))){
			$this->Competition->id = $id;
			// $this->Competition->locale = Configure::read('Config.languages');
			// debug($this->Competition->locale);
			// debug($this->request->data);
			$data1 = $this->request->data['Competition'];
			if(!$data1['img']['name']){
				unset($data1['img']);
			}

			
			// $this->Competition->locale = 'kz';
			// debug($data1);
			$data1['id'] = $id;
			if($this->Competition->save($data1)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
		//Заполняем данные в форме
		if(!$this->request->data)
		{
			$this->request->data = $data;
			$this->set(compact('id', 'data'));
		}

	}

	public function admin_delete($id){
		if (!$this->Competition->exists($id)) {
			throw new NotFounddException('Такой страницы нет');
		}
		if($this->Competition->delete($id)){
			$this->Session->setFlash('Удалено', 'default', array(), 'good');
		}else{
			$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
		}
		return $this->redirect($this->referer());
	}

	public function view($id){
		if(is_null($id) || !(int)$id || !$this->Competition->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		if($this->request->is('post')){
			// debug($this->request->data);
			$member_id = $this->request->data['member_id'];
			$competition_id = $this->request->data['competition_id'];

			// debug($competition_id);
			// die;
			$setLike = $this->_setLike($member_id);
			// $setAnons = $this->_anons($news_id, $anons);
			if($setLike){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}

		$this->News->locale = Configure::read('Config.language');
		$this->News->bindTranslation(array('title' => 'titleTranslation', 'body' => 'bodyTranslation'));
		$this->Gallery->locale = Configure::read('Config.language');
		$this->Gallery->bindTranslation(array('title' => 'titleTranslation'));
		$stol = $this->News->find('all', array(
            'conditions' => array('category_id' => 5),
            'limit' => 3
        ));
        $galleries = $this->Gallery->find('all', array(
            'limit' => 3
        ));
        $this->Competition->unbindModel(
	        array('hasMany' => array('Member'))
	    );
		$data = $this->Competition->findById($id);
		$members = $this->Member->find('all', array(
			'conditions' => array('Member.active' => 1)
		));
		// debug($data);
		// $r = $this->_setLike($id);
		
		$title_for_layout = $data['Competition']['title'];
		$meta['keywords'] = $data['Competition']['keywords'];
		$meta['description'] = $data['Competition']['description'];
		$this->set(compact('title_for_layout', 'meta', 'data', 'stol', 'galleries', 'members'));
	}

	protected function _setLike($member_id){
		$ip = $_SERVER["REMOTE_ADDR"]; // Преобразуем IP в число
		$count = $this->Like->find('count', array(
			'conditions' => array('Like.ip' => $ip, 'Like.member_id' => $member_id)
		));

		if($count == 0){
			//$this->Session->write('visits', '1');
			$data = array('member_id' => $member_id, 'ip' => $ip);
			
			$this->Like->save($data);
			return true;
		}
	}

	public function getVotes($member_id){
		$count = $this->Like->find('count', array(
			'conditions' => array('Like.member_id' => $member_id)
		));
		return $count;
	}
}