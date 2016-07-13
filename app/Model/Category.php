<?php

class Category extends AppModel {
	public $actsAs = array(
		'Translate' => array(
			'title'
			)
		);
	// public $useTable = 'i18n';
	// public $displayField = 'field';
	// public $translateModel = 'CategoryI18n';
	public $translateTable = 'i18n'; //если че удалить

    public $hasMany = array(
        'Article' => array(
            'className'  => 'Article',
            // 'conditions' => array('Recipe.approved' => '1'),
            // 'order'      => 'Recipe.created DESC'
        ),
        'Investor' => array(
            'className'  => 'Investor',
            // 'conditions' => array('Recipe.approved' => '1'),
            // 'order'      => 'Recipe.created DESC'
        ),
        
    );
}
?>