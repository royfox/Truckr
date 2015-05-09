<?php

App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class PostsController extends AppController {

    public $name = 'Posts';
    public $helpers = array('Html', 'Form','Text', 'Time', 'Gravatar', 'AjaxMultiUpload.Upload','Paginator');
    public $components = array('Session', 'Mention', 'Slack');
    public $paginate = array(
        'order' => array('modified'=>'desc'),
        'contain' => array('Comment','Comment.User', 'Room.Subscriber','Room.Subscriber.User','User', 'Room'),
        'limit' => 50
    );

    public function index() {
       $this->set('posts', $this->paginate('Post'));
    }

    public function view($id) {
        $this->Post->id = $id;
        $this->Post->contain(array('Comment','Comment.User', 'Room.Subscriber','Room.Subscriber.User','User', 'Room'));
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
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                $mentionedUsers = $this->Mention->getMentionedUserIds($this->request->data['Post']['content'], $this->Post->User->find('all'));
                $notifiedUserNames = $this->Post->notify($this->Post->id, $mentionedUsers);
                $this->Session->setFlash('Your post has been saved. The following users were notified: '.join(", ", $notifiedUserNames));
                $post = $this->Post->read();
                $this->Slack->newPost($post);
                $this->redirect(array('action' => 'view', $this->Post->id));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
        $rooms = $this->Post->Room->find('list');
        $this->set("rooms", $rooms);
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
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view', $this->Post->id));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }
        $rooms = $this->Post->Room->find('list');
        $this->set("rooms", $rooms);
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

    function ciconia(){
        $this->layout = 'ajax';
        $this->set("markdown", $this->request['data']['markdown']);
    }

}
