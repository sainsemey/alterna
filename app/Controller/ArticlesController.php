<?php

class ArticlesController extends AppController{
	public $uses = array('Article', 'Category', 'Country');
	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index(){
		$this->Article->locale = Configure::read('Config.language');
		$this->Article->bindTranslation(array('title' => 'titleTranslation'));
		$data = $this->Article->find('all', array(
			'order' => array('Article.id' => 'desc')
		));
		$title_for_layout = __('Полезная информация');
		$this->set(compact('title_for_layout', 'data'));
	}
		

	public function search(){
		$this->Article->locale = Configure::read('Config.language');
		$this->Article->bindTranslation(array('title' => 'titleTranslation'));
		$this->Gallery->locale = Configure::read('Config.language');
		$this->Gallery->bindTranslation(array('title' => 'titleTranslation'));
		$galleries = $this->Gallery->find('all', array(
            'limit' => 3
        ));
		$stol = $this->Article->find('all', array(
            'conditions' => array('category_id' => 5),
            'limit' => 3
        ));
		$search = !empty($_GET['q']) ? $_GET['q'] : null;
		if(is_null($search)){
			$search_res = __('Введите пойсковый запрос...');
			return $this->set(compact('search_res'));
		}
		$categories = $this->Category->find('all');
		$title_for_layout = __('Поиск');
		$search_res = $this->Article->query("SELECT * FROM i18n 
			WHERE i18n.content LIKE '%{$search}%'");
		$this->set(compact('search_res', 'title_for_layout', 'categories', 'stol', 'galleries'));
	}

	public function admin_index(){
		$this->Article->locale = array('ru', 'kz');
		$this->Article->bindTranslation(array(
			'title' => 'titleTranslation',
			'body' => 'bodyTranslation',
			'keywords' => 'keywordsTranslation',
			'description' => 'descriptionTranslation'
		));
		$data = $this->Article->find('all');
		
		if($this->request->is('post')){
			$anons = $this->request->data['Article']['anons'];
			$news_id = $this->request->data['Article']['news_id'];
			// debug($news_id);
			// die;

			// debug($news_id);
			$setAnons = $this->_anons($news_id, $anons);
			if($setAnons){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
		$this->set(compact('data'));
	}

	public function admin_add(){
		if($this->request->is('post')){
			$this->Article->create();
			$data = $this->request->data['Article'];
			// debug($this->request->data);
			// debug($data);
			 if(!$data['img']['name']){
			 	unset($data['img']);
			}
			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Article->locale = 'kz';
			}elseif(isset($this->request->query['lang']) && $this->request->query['lang'] == 'en'){
				$this->Article->locale = 'en';
			}else{
				$this->Article->locale = 'ru';
			}
			// $this->Article->locale = 'ru';
			if($this->Article->save($data)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
			$this->Category->locale = 'ru';
			$categories = $this->Category->find('list');
			$countries = $this->Country->find('list');
			$this->set(compact('categories', 'countries'));
	}

	public function admin_edit($id){

		if(is_null($id) || !(int)$id || !$this->Article->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		$data = $this->Article->findById($id);
		if(!$id){
			throw new NotFoundException('Такой страницы нет...');
		}
		if($this->request->is(array('post', 'put'))){
			$this->Article->id = $id;
			// $this->Article->locale = Configure::read('Config.languages');
			// debug($this->Article->locale);
			// debug($this->request->data);
			$data1 = $this->request->data['Article'];
			if(!isset($data1['img']['name']) || !$data1['img']['name']){
				unset($data1['img']);
			}

			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Article->locale = 'kz';
				$this->Category->locale = 'kz';
			}elseif(isset($this->request->query['lang']) && $this->request->query['lang'] == 'en'){
				$this->Article->locale = 'en';
				$this->Category->locale = 'en';
			}else{
				$this->Article->locale = 'ru';
				$this->Category->locale = 'ru';
			}
			
			// $this->Article->locale = 'kz';
			// debug($data1);
			$data1['id'] = $id;
		// 	debug($data1);
		// die;
			
			if($this->Article->save($data1)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
		//Заполняем данные в форме
		if($this->request->is('post')){
			$this->request->data = $data1;
			$data = $data1;
		}else{
			$this->Article->locale = $this->request->query['lang'];
			$data = $this->request->data = $this->Article->read(null, $id);
		}
			
				$this->Category->locale = 'ru';
			$categories = $this->Category->find('list');
			$this->set(compact('id', 'data', 'categories'));

	}

	public function admin_delete($id){
		if (!$this->Article->exists($id)) {
			throw new NotFounddException('Такой статьи нет');
		}
		if($this->Article->delete($id)){
			$this->Session->setFlash('Удалено', 'default', array(), 'good');
		}else{
			$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
		}
		return $this->redirect($this->referer());
	}

	public function view($id){
		if(is_null($id) || !(int)$id || !$this->Article->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		$this->Article->locale = Configure::read('Config.language');
		$this->Article->bindTranslation(array('title' => 'titleTranslation', 'body' => 'bodyTranslation'));
		$post = $this->Article->findById($id);
	
		$title_for_layout = $post['Article']['title'];
		$meta['keywords'] = $post['Article']['keywords'];
		$meta['description'] = $post['Article']['description'];
		$this->set(compact('post', '','title_for_layout' ,'meta'));
	}

}