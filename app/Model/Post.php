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

    public $belongsTo = array('User', 'Room');
    public $hasMany = array(
        "Comment" => array(
            'dependent' => true
        )
    );

    public function notify($id, $mentionedUserIds){
        $this->id = $id;
        $this->contain(array('Room.Subscriber','Room.Subscriber.User','User', 'Comment', 'Comment.User'));
        $post = $this->read();

        $notifiedUsers = [];
        $notifiedUserNames = [];

        //First, notify all subscribers to the room
        foreach($post['Room']['Subscriber'] as $subscriber){
            if($subscriber['User']['active'] && $post['Post']['user_id'] != $subscriber['user_id']){
                $this->sendEmail(
                    $subscriber['User']['email'],
                    $post,
                    in_array($subscriber['user_id'], $mentionedUserIds)
                );
                $notifiedUsers[] = $subscriber['user_id'];
                $notifiedUserNames[] = $subscriber['User']['display_name'];
            }
        }

        //Then notify mentioned users
        foreach($mentionedUserIds as $mentionedUserId) {
           if(!in_array($mentionedUserId, $notifiedUsers) && $post['Post']['user_id'] != $mentionedUserId) {
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'id' => $mentionedUserId
                    )
                ));
               $this->sendEmail(
                   $user['User']['email'],
                   $post,
                   in_array($user['User']['id'], $mentionedUserIds)
               );
               $notifiedUserNames[] = $user['User']['display_name'];
           }
        }
        return $notifiedUserNames;
    }

    private function sendEmail($emailAddress, $post, $wasUserMentioned) {
        $email = new CakeEmail();
        $email->from(array(Configure::read("Email.SenderAddress") => Configure::read("Email.SenderName")));
        $email->to($emailAddress);
        $email->template('new_post');
        $email->emailFormat('html');
        $email->helpers(array('Html'));
        $email->subject("[Truckr] ". $post['Post']['title']);
        $email->viewVars(array(
            'post' => $post,
            'urlRoot' => Configure::read("Email.UrlRoot"),
            'userWasMentioned' => $wasUserMentioned
        ));
        $email->send();
    }

}
