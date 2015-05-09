<?php

class Room extends AppModel {
    public $actsAs = array('Containable');
    public $name = 'Room';

    public $hasMany = array(
        "Post" => array(
            'dependent' => true
        ),
        "Subscriber" => array(
            'dependent' => true
        )
    );

    public function addSubscribers($subscriber_ids, $room_id = null){
        foreach($subscriber_ids as $subscriber_id){
            $existingEntry = $this->Subscriber->find('first', array(
                'conditions' => array(
                    'Subscriber.room_id' => $room_id === null ? $this->id : $room_id,
                    'Subscriber.user_id' => $subscriber_id
                )
            ));
            if(!$existingEntry){
                $this->Subscriber->create();
                $this->Subscriber->save(array(
                    'room_id' => $room_id === null ? $this->id : $room_id,
                    'user_id' => $subscriber_id
                ));
            }
        }
    }

    public function setSubscribers($subscriber_ids){
        $subscriber_ids = array_unique($subscriber_ids);

        $this->Subscriber->deleteAll(array(
            'Room.id' => $this->id
        ));

        foreach($subscriber_ids as $subscriber_id){
            $this->Subscriber->create();
            $this->Subscriber->save(array(
                'room_id' => $this->id,
                'user_id' => $subscriber_id
            ));
        }
    }


}
