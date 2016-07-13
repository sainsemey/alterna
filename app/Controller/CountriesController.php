<?php

class CountriesController extends AppController{

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function admin_index(){
		$this->Country->locale = 'ru';
		$this->Country->bindTranslation(array(
			'title' => 'titleTranslation'
		));
		$data = $this->Country->find('all');
		$this->set(compact('data'));
	}

	public function admin_add(){
		if($this->request->is('post')){
			$this->Country->create();
			$data = $this->request->data['Country'];

			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Country->locale = 'kz';
			}else{
				$this->Country->locale = 'ru';
			}
			if($this->Country->save($data)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
	}

	public function admin_edit($id){
		
		if(is_null($id) || !(int)$id || !$this->Country->exists($id)){
			throw new NotFoundException('Такой категории нет...');
		}
		$data = $this->Country->findById($id);
		if(!$id){
			throw new NotFoundException('Такой категории нет...');
		}
		if($this->request->is(array('post', 'put'))){
			$this->Country->id = $id;
			// $this->Country->locale = Configure::read('Config.languages');
			// debug($this->Country->locale);
			// debug($this->request->data);
			$data1 = $this->request->data['Country'];

			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Country->locale = 'kz';
			}elseif(isset($this->request->query['lang']) && $this->request->query['lang'] == 'en'){
				$this->Country->locale = 'en';
			}else{
				$this->Country->locale = 'ru';
			}
			// $this->Country->locale = 'kz';
			// debug($data1);
			$data1['id'] = $id;
			if($this->Country->save($data1)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
		//Заполняем данные в форме
		if($this->request->is('post')){
			$this->request->data = $data1;
			$data = $data1;
		}else{
			$this->Country->locale = $this->request->query['lang'];
			$data = $this->request->data = $this->Country->read(null, $id);
		}
			$this->set(compact('id', 'data'));
	}

	public function admin_delete($id){
		if (!$this->Country->exists($id)) {
			throw new NotFounddException('Такой категории нет');
		}
		if($this->Country->delete($id)){
			$this->Session->setFlash('Удалено', 'default', array(), 'good');
		}else{
			$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
		}
		return $this->redirect($this->referer());
	}

}