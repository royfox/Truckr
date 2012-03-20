<?php

class AppController extends Controller {

    public $components = array("Auth","Session");

    function beforeFilter() {
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'username', 'password' => 'password');
        $this->Auth->loginAction = array('admin' => false, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'index');
    }

}