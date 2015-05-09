<?php

App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class RoomsController extends AppController {

    public $name = 'Rooms';
    public $components = array('Session');
    public $helpers = array('Html', 'Form','Text',"Time");

    public function index() {
       $this->Room->hasMany['Post']['limit'] = 2;
       $this->Room->hasMany['Post']['order'] = 'created DESC';
       $rooms = $this->Room->find('all',array(
            'order' => array('name desc'),
            'contain' => array('Post', 'Post.Comment','Post.Comment.User', 'Post.Subscriber','Post.Subscriber.User','Post.User', 'Post.Room')
       ));
        foreach($rooms as &$room){
            foreach($room['Post'] as &$post){
                $post['Post'] = $post;
            }
        }
        $postCounts = $this->Room->Post->find('all', array(
            'fields' => array('room_id, COUNT(room_id) as count'),
            'group' => array('room_id')
        ));

        $postCountMap = array();
        foreach($postCounts as $postCount) {
            $postCountMap[$postCount['Post']['room_id']] = $postCount[0]['count'];
        }


       unset($room); unset($post);
       usort($rooms, function($a, $b){
           $maxA = 0;
           $maxB = 0;
            foreach($a['Post'] as $post){
                if(strtotime($post['created']) > $maxA){
                    $maxA = strtotime($post['created']);
                }
            }
           foreach($b['Post'] as $post){
               if(strtotime($post['created']) > $maxB){
                   $maxB = strtotime($post['created']);
               }
           }
           return $maxB - $maxA;
       });
        $this->set("rooms", $rooms);
        $this->set("postCounts", $postCountMap);
    }

    public function view($id = null) {
        $this->Room->id = $id;
        if (!$this->Room->exists()) {
            throw new NotFoundException(__('Invalid room'));
        }
        $this->set('room', $this->Room->read(null, $id));
        $this->set('posts', $this->Room->Post->find('all',array(
             'order' => array('modified desc'),
             'conditions' => array(
                'Room.id' => $id
             ),
            'contain' => array('Comment','Comment.User', 'Subscriber','Subscriber.User','User', 'Room')
        )));
    }

    public function add(){
        if ($this->request->is('post')) {
            $this->Room->create();
            if ($this->Room->save($this->request->data)) {
                $this->Session->setFlash(__('The room has been created'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The room could not be created. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->Room->id = $id;
        if (!$this->Room->exists()) {
            throw new NotFoundException(__('Invalid room'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Room->save($this->request->data)) {
                $this->Session->setFlash(__('Room updated OK'));
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('Your room could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Room->read(null, $id);
        }
    }

}
