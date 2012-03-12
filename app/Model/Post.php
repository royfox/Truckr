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

    public function notify($id){
        $this->id = $id;
        $this->contain(array('Subscriber','Subscriber.User','User'));
        $post = $this->read();
        foreach($post['Subscriber'] as $subscriber){
            if($post['Post']['user_id'] != $subscriber['user_id']){
                $email = new CakeEmail();
                $email->from(array(Configure::read("Email.SenderAddress") => Configure::read("Email.SenderName")));
                $email->to($subscriber['User']['email']);
                $email->template('new_post');
                $email->emailFormat('html');
                $email->helpers(array('Markdown.Markdown', 'Html'));
                $email->subject("[Truckr] ".$post['Post']['title']);
                $email->viewVars(array(
                    'post' => $post,
                    'urlRoot' => Configure::read("Email.UrlRoot")
                ));
                $email->send();
            }
        }
    }
}