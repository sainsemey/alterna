<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller', 'CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('App', 'Article', 'Service');

	public $components = array('DebugKit.Toolbar', 'Cookie', 'Session', 'Auth' => array(
            'loginRedirect' => '/admin/',
            'logoutRedirect' => '/',
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        ));
	public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() {

        parent::beforeFilter();

        // debug($this->request->params['prefix']);
        $admin = (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') ? 'admin/' : false;
        if(!$admin) $this->Auth->allow();
        if($admin){
            $this->layout = 'default';
        }else{
            if($this->params['action']=='home'){
                $this->layout = 'index';
            }else{
                $this->layout = 'page';
            }
        }

        if(isset($this->params['language']) && $this->params['language'] == 'kz'){
            Configure::write('Config.language', 'kz');

        }elseif(isset($this->params['language']) && $this->params['language'] == 'en'){
            Configure::write('Config.language', 'en');
        }else{
            Configure::write('Config.language', 'ru');
        }
        $this->Service->locale = Configure::read('Config.language');
        $services = $this->Service->find('all', array(
        'fields' => array('id', 'title'),
        // 'conditions' => array('Service.parent_id' => 0)
        ));
        $lang = ($this->params['language']) ? $this->params['language'] . '/' : '';
        $this->set(compact('admin', 'lang', 'services'));

    }

}
