<?php

App::uses('Sanitize', 'Utility');

class PostsController extends AppController {

    public $name = 'Posts';
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown");
    public $components = array('Session');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());

    }

    public function add() {
            if ($this->request->is('post')) {
                $this->request->data['created_at'] = date("Y-m-d H:i:s");
                $this->request->data['updated_at'] = date("Y-m-d H:i:s");
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash('Your post has been saved.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to add your post.');
                }
            }
        }

    function edit($id = null) {
        $this->Post->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            $this->Post->updated_at = date("Y-m-d H:i:s");
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view', $this->Post->id));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }
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