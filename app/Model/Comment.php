<?php

class Comment extends AppModel {

    public $name = 'Comment';
    public $belongsTo = array('Post', 'User');
    public $actsAs = array('Containable');

    public function notify($id, $mentionedUserIds){
        $this->id = $id;
        $this->contain(array('Post','Post.Subscriber','Post.Subscriber.User','User'));
        $comment = $this->read();
        foreach($comment['Post']['Subscriber'] as $subscriber){
            if($subscriber['User']['active'] && $comment['Comment']['user_id'] != $subscriber['user_id']){
                $email = new CakeEmail();
                $email->from(array(Configure::read("Email.SenderAddress") => Configure::read("Email.SenderName")));
                $email->to($subscriber['User']['email']);
                $email->template('new_comment');
                $email->emailFormat('html');
                $email->helpers(array('Html'));
                $email->subject("[Truckr] ".$comment['Post']['title']);
                $email->viewVars(array(
                    'comment' => $comment,
                    'urlRoot' => Configure::read("Email.UrlRoot"),
                    'userWasMentioned' => in_array($subscriber['user_id'], $mentionedUserIds)
                ));
                $email->send();
            }
        }
    }

}