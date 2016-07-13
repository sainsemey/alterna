<?php 

class SearchController extends AppController{
	// public $uses = false;

	public function index(){
		if(isset($this->request->query['q']) && !empty($this->request->query['q'])){
			$q = $this->request->query['q'];
			$res = $this->Service->query('SELECT * FROM i18n WHERE i18n.field="title" AND i18n.model!="Page" AND i18n.model!="Country" AND i18n.model!="Category" AND i18n.content LIKE "%'.$q.'%"');
			// $res = $this->_unique($res);
			// $res = array_unique($res);
			// debug($res);
			
		}else{
			$res = __('Введите запрос...');
		}
		$title_for_layout = __('Поиск');
		$this->set(compact('res', 'title_for_layout'));
	}

	protected function _unique($array){
		if(is_array($array)){
			foreach ($array as $item) {
				$list[] = $item['i18n']['foreign_key'].$item['i18n']['model'];
			}
			return $list;
		}else{
			return 'Ошибка';
		}
	}
}