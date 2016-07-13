<?php 

class MembersController extends AppController{

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index(){
		// $this->Member->locale = false;
		$this->Member->locale = 'ru';
		$data = $this->Member->find('all', array(
			'order' => array('id' => 'ASC')
		));
		$title_for_layout = __('Конкурсы');
		$this->set(compact('data', 'title_for_layout'));
	}

	public function admin_index(){
		$this->Member->locale = 'ru';
		
		$data = $this->Member->find('all');
		// debug($data);
		$this->set(compact('data'));
	}

	public function admin_members($id){
		if(is_null($id) || !(int)$id || !$this->Member->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		$data = $this->Member->findById($id);
		$members = $data['Member'];
		// debug($data);
		$this->set(compact('members'));
	}

	public function admin_add(){
		if($this->request->is('post')){
			$this->Member->create();
			$data = $this->request->data['Member'];

			 if(!$data['img']['name']){
			 	unset($data['img']);
			}
			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Member->locale = 'kz';
			}else{
				$this->Member->locale = 'ru';
			}
			if($this->Member->save($data)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
	}

	public function admin_edit($id){
		
		if(is_null($id) || !(int)$id || !$this->Member->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		$data = $this->Member->findById($id);
		if(!$id){
			throw new NotFoundException('Такой страницы нет...');
		}
		if($this->request->is(array('post', 'put'))){
			$this->Member->id = $id;
			// $this->Member->locale = Configure::read('Config.languages');
			// debug($this->Member->locale);
			// debug($this->request->data);
			$data1 = $this->request->data['Member'];
			if(!$data1['img']['name']){
				unset($data1['img']);
			}

			
			// $this->Member->locale = 'kz';
			// debug($data1);
			$data1['id'] = $id;
			if($this->Member->save($data1)){
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
		if (!$this->Member->exists($id)) {
			throw new NotFounddException('Такой страницы нет');
		}
		if($this->Member->delete($id)){
			$this->Session->setFlash('Удалено', 'default', array(), 'good');
		}else{
			$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
		}
		return $this->redirect($this->referer());
	}

	public function view($id){
		if(is_null($id) || !(int)$id || !$this->Member->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		
		//$r = $this->_visit_add($id);
		
		$title_for_layout = $post['Member']['title'];
		$meta['keywords'] = $post['Member']['keywords'];
		$meta['description'] = $post['Member']['description'];
		$this->set(compact('title_for_layout', 'meta'));
	}

	public function request(){
		if($this->request->is('post')){
		$this->Member->create();
		$data = $this->request->data['Member'];
		debug($data);
		die;
		//$data = array('member_id' => $member_id, 'ip' => $ip);
		// $this->Like->save($data);
		if($this->Member->save($data)){
			$this->Session->setFlash('Сохранено', 'default', array(), 'good');
			// debug($data);
			return $this->redirect($this->referer());
		}else{
			$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
		}
		}
	}
}