<?php

App::uses('Sanitize', 'Utility');

class SubscribersController extends AppController {

    public $name = 'Subscribers';
    public $components = array('Session');

    public function delete($room_id) {
        $subscriber = $this->Subscriber->find('first', array(
            'conditions' => array(
                'Subscriber.user_id' => $this->Auth->user('id'),
                'Subscriber.room_id' => $room_id
        )));
        if($subscriber){
            $this->Subscriber->delete($subscriber['Subscriber']['id']);
            $this->Session->setFlash('Your have unsubscribed successfully', 'flash_success');
            $this->redirect(array('controller'=>'rooms','action'=>'view', $room_id));
        } else {
            throw new BadRequestException();
        }
    }
    public function add($room_id) {
        $subscriber = $this->Subscriber->find('first', array(
            'conditions' => array(
                'Subscriber.user_id' => $this->Auth->user('id'),
                'Subscriber.room_id' => $room_id
        )));
        if(!$subscriber){
            $this->Subscriber->create();
            $this->Subscriber->save(array(
                'room_id' => $room_id,
                'user_id' => $this->Auth->user('id')
            ));
            $this->Session->setFlash('Your have subscribed successfully', 'flash_success');
            $this->redirect(array('controller'=>'rooms','action'=>'view', $room_id));
        } else {
            throw new BadRequestException();
        }
    }
}
