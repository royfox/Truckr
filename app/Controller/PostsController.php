<?php

App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class PostsController extends AppController {

    public $name = 'Posts';
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown","Gravatar", "AjaxMultiUpload.Upload","Paginator");
    public $components = array('Session');
    public $paginate = array(
        'order' => array('created'=>'desc'),
        'contain' => array('Comment','Comment.User', 'Subscriber','Subscriber.User','User'),
        'limit' => 50
    );

    public function index() {
       $this->set('posts', $this->paginate('Post'));

    }

    public function view($id) {
        $this->Post->id = $id;
        $this->Post->contain(array('Comment','Comment.User', 'Subscriber','Subscriber.User','User'));
        $this->Post->recursive = 1;
        $post = $this->Post->read();
        if(!$post){
            throw new NotFoundException();
        }
        $this->set('post', $post);
    }

    public function add() {
        $this->set("hide_navigation", true);
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Post->set('user_id', $this->Auth->user('id'));
                $this->Post->save();
                $this->Post->setSubscribers($this->request->data['Post']['Subscriber'], $this->Auth->user('id'));
                $this->Session->setFlash('Your post has been saved.');
                $this->Post->notify($this->Post->id);
                $this->redirect(array('action' => 'view', $this->Post->id));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
        $this->set('users', $this->Post->User->find('list', array(
            'fields' => array('User.display_name'),
            'order'=>'display_name asc',
            'conditions' => array(
                'User.id !=' => $this->Auth->user('id'),
                'User.active' => 1
            )
        )));
    }


    function edit($id = null) {
        $this->set("hide_navigation", true);
        $this->Post->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            if ($this->Post->save($this->request->data)) {
                $this->Post->setSubscribers($this->request->data['Post']['Subscriber'], $this->Auth->user('id'));
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view', $this->Post->id));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }
        $this->set("subscribers", array_values($this->Post->Subscriber->find('list', array(
            'conditions' => array(
                'Subscriber.post_id' => $id,
            ),
            'fields' => array('Subscriber.user_id'),
        ))));
        $this->set('users', $this->Post->User->find('list', array(
            'fields' => array('User.display_name'),
            'order'=>'display_name asc',
            'conditions' => array(
                'User.id !=' => $this->Auth->user('id')
            )
        )));
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
        $query = isset($this->request->query['query']) ? $this->request->query['query'] : (isset($this->request->params['named']['query'])? $this->request->params['named']['query'] : false);
        if($query){
            $this->set("query", $query);
            $this->set('posts', $this->paginate('Post', array(
                    'OR' => array(
                        array('Post.title LIKE' => "%$query%"),
                        array('Post.content LIKE' => "%$query%")
                    )
                )
            ));
        } else {
            $this->Session->setFlash('No search query!');
            $this->redirect("/");
        }
    }

}
