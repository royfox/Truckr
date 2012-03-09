<?php
class Post extends AppModel {
    
    public $name = 'Post';
    public $actsAs = array('Containable');
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'content' => array(
            'rule' => 'notEmpty'
        )
    );

    public $belongsTo = array('Category', 'User', 'Subject');
    public $hasMany = array(
        "Comment" => array(
            'dependent' => true
        ),
        "Subscriber" => array(
            'dependent' => true
         )
    );


    public function setSubscribers($subscriber_ids, $user_id){

        $subscriber_ids[] = $user_id;
        $subscriber_ids = array_unique($subscriber_ids);

        $this->Subscriber->deleteAll(array(
            'Post.id' => $this->id
        ));

        foreach($subscriber_ids as $subscriber_id){
            $this->Subscriber->create();
            $this->Subscriber->save(array(
                'post_id' => $this->id,
                'user_id' => $subscriber_id
            ));
        }


    }
}