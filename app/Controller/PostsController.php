<?php

App::uses('Sanitize', 'Utility');

class PostsController extends AppController {

    public $name = 'Posts';
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown");
    public $components = array('Session');

    public function index() {
        $this->set('posts', $this->Post->find('all',
            array('order' => array('modified desc'))
        ));
    }

    public function view($id) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->user_id = $this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
        $this->set('categories', $this->Post->Category->find('list', array('order'=>'name asc')));
        $this->set('subjects', $this->Post->Subject->find('list', array('order'=>'name asc')));
    }

    function edit($id = null) {
        $this->Post->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            $this->Post->user_id = $this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view', $this->Post->id));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }
        $this->set('categories', $this->Post->Category->find('list', array('order'=>'name asc')));
        $this->set('subjects', $this->Post->Subject->find('list', array('order'=>'name asc')));
    }
    function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The post has been deleted');
            $this->redirect(array('action' => 'index'));
        }
    }

}