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
        $this->Post->recursive = 3;
        $this->set('post', $this->Post->read());
    }

    public function add() {
        $this->set("hide_navigation", true);
        if ($this->request->is('post')) {
            $this->Post->user_id = $this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                $this->Post->set('user_id', $this->Auth->user('id'));
                $this->Post->save();
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
        $this->set("hide_navigation", true);
        $this->Post->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
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
    function search(){
        if(isset($this->params->query['query'])){
            $query = $this->params->query['query'];
            $this->set("query", $query);
            $this->set('posts', $this->Post->find('all', array(
                'order' => array('modified desc'),
                'conditions' =>  array(
                    'OR' => array(
                        array('Post.title LIKE' => "%$query%"),
                        array('Post.content LIKE' => "%$query%")
                    )
                )
            )));
        } else {
            $this->Session->setFlash('No search query!');
            $this->redirect("/");
        }
    }

}