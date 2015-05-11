<?php

App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class RoomsController extends AppController {

    public $name = 'Rooms';
    public $components = array('Session');
    public $helpers = array('Html', 'Form','Text',"Time");

    public function index() {
       $this->Room->hasMany['Post']['limit'] = 1;
       $this->Room->hasMany['Post']['order'] = 'created DESC';
       $rooms = $this->Room->find('all',array(
            'order' => array('name desc'),
            'contain' => array('Post', 'Post.Comment','Post.Comment.User', 'Subscriber','Subscriber.User','Post.User', 'Post.Room')
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
        $room = $this->Room->find('first',array(
            'conditions' => array(
                'Room.id' => $id
            ),
            'order' => array('name desc'),
            'contain' => array('Subscriber','Subscriber.User')
        ));
        $this->set('room', $room);
        $this->set('posts', $this->Room->Post->find('all',array(
             'order' => array('modified desc'),
             'conditions' => array(
                'Room.id' => $id
             ),
            'contain' => array('Comment','Comment.User', 'Room.Subscriber','Room.Subscriber.User','User', 'Room')
        )));
    }

    public function add(){
        if ($this->request->is('post')) {
            $this->Room->create();
            if ($this->Room->save($this->request->data)) {
                $this->Room->setSubscribers($this->request->data['Room']['Subscriber']);
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
                $this->Room->setSubscribers($this->request->data['Room']['Subscriber']);
                $this->Session->setFlash(__('Room updated OK'));
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('Your room could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Room->read(null, $id);
        }
        $this->set("subscribers", array_values($this->Room->Subscriber->find('list', array(
            'conditions' => array(
                'Subscriber.room_id' => $id,
            ),
            'fields' => array('Subscriber.user_id'),
        ))));
        $this->set('users', $this->Room->Post->User->find('list', array(
            'fields' => array('User.display_name'),
            'order'=>'display_name asc',
            'conditions' => array(
                'User.active' => 1
            )
        )));
    }

}
