<?php

class AppController extends Controller {

    public $components = array("Auth","Session");

    function beforeFilter() {
        $this->Auth->userModel = 'User';
        $this->Auth->fields = array('username' => 'username', 'password' => 'password');
        $this->Auth->loginAction = array('admin' => false, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'index');
        
        App::import('Model', 'Category');
        App::import('Model', 'Subject');
        $subject = new Subject();
        $this->set("all_subjects_for_navigation", $subject->find("all", array('order'=>'name asc')));
        $category = new Category();
        $this->set("all_categories_for_navigation", $category->find("all", array('order'=>'name asc')));

    }

}