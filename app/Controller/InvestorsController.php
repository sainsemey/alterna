<?php 

class InvestorsController extends AppController{

	public $uses = array('Investor', 'Category', 'Country');
	
	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index(){
		$this->Investor->locale = Configure::read('Config.language');
		$this->Investor->bindTranslation(array('title' => 'titleTranslation'));
		$this->Country->locale = Configure::read('Config.language');
		$this->Country->bindTranslation(array('title' => 'titleTranslation'));
		$this->Category->locale = Configure::read('Config.language');
		$this->Category->bindTranslation(array('title' => 'titleTranslation'));
		$data = $this->Investor->find('all', array(
			'order' => array('Investor.id' => 'desc')
		));
		$countries = $this->Country->find('list');
		$categories = $this->Category->find('list');
		$title_for_layout = __('Инвесторам');

		//Фильтр
		if(!empty($this->request->query('country')) || !empty($this->request->query('category'))){
		if($this->request->query('country')) $params['country_id'] = $this->request->query('country');
		if($this->request->query('category')) $params['category_id'] = $this->request->query('category');
			$data = $this->Investor->find('all', array(
				'conditions' => array($params)
			));
		}
		$this->set(compact('data', 'title_for_layout', 'countries', 'categories'));
	}

	public function admin_index(){
		$this->Investor->locale = array('ru', 'kz', 'en');
		$this->Investor->bindTranslation(array(
			'title' => 'titleTranslation'
		));
		$data = $this->Investor->find('all');
		$this->set(compact('data'));
	}

	public function admin_add(){
		if($this->request->is('post')){
			
			$this->Investor->create();
			$data = $this->request->data['Investor'];

			 if(!isset($data['img']['name']) || !$data['img']['name']){
			 	unset($data['img']);
			}
			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Investor->locale = 'kz';
			}elseif(isset($this->request->query['lang']) && $this->request->query['lang'] == 'en'){
				$this->Investor->locale = 'en';
			}else{
				$this->Investor->locale = 'ru';
			}
			// $this->Investor->locale = 'ru';

			if($this->Investor->save($data)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				// debug($data);
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
			}
		}
		$this->Category->locale = 'ru';
		$this->Country->locale = 'ru';
		$categories = $this->Category->find('list');
		$countries = $this->Country->find('list');
		$this->set(compact('categories', 'countries'));
	}

	public function admin_edit($id){
		if(is_null($id) || !(int)$id || !$this->Investor->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}
		$data = $this->Investor->findById($id);

		if(!$id){
			throw new NotFoundException('Такой страницы нет...');
		}
		if($this->request->is(array('post', 'put'))){
			$this->Investor->id = $id;
			$data1 = $this->request->data['Investor'];
			
			if(!isset($data1['img']['name']) || !$data1['img']['name']){
				unset($data1['img']);
			}
			if(isset($this->request->query['lang']) && $this->request->query['lang'] == 'kz'){
				$this->Investor->locale = 'kz';
			}elseif(isset($this->request->query['lang']) && $this->request->query['lang'] == 'en'){
				$this->Investor->locale = 'en';
			}else{
				$this->Investor->locale = 'ru';
			}
			// debug($this->Investor->save($data1));
			$data1['id'] = $id;
			if($this->Investor->save($data1)){
				$this->Session->setFlash('Сохранено', 'default', array(), 'good');
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Ошибка!', 'default', array(), 'bad');
			}
		}
		//Заполняем данные в форме
		if($this->request->is('post')){
			$this->request->data = $data1;
			$data = $data1;
		}else{
			$this->Investor->locale = $this->request->query['lang'];
			$data = $this->request->data = $this->Investor->findById($id);
		}
		$this->Category->locale = 'ru';
		$this->Country->locale = 'ru';
		$categories = $this->Category->find('list');
		$countries = $this->Country->find('list');

		$this->set(compact('id', 'data', 'categories', 'countries'));
	}

	public function admin_delete($id){
		if (!$this->Investor->exists($id)) {
			throw new NotFounddException('Такого материала нет');
		}
		if($this->Investor->delete($id)){
			$this->Session->setFlash('Удалено', 'default', array(), 'good');
		}else{
			$this->Session->setFlash('Ошибка', 'default', array(), 'bad');
		}
		return $this->redirect($this->referer());
	}

	public function view($id){
		if(is_null($id) || !(int)$id || !$this->Investor->exists($id)){
			throw new NotFoundException('Такой страницы нет...');
		}

		$this->Investor->locale = Configure::read('Config.language');
		$this->Investor->bindTranslation(array('title' => 'titleTranslation'));

		$data = $this->Investor->findById($id);
		$projects = $this->Investor->find('all', array(
			'conditions' => array('Investor.id !=' => $id)
		));
		$title_for_layout = $data['Investor']['title'];
		$this->set(compact('data', 'projects', 'title_for_layout'));
	}
}