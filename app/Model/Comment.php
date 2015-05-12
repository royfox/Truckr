<?php

class Comment extends AppModel {

    public $name = 'Comment';
    public $belongsTo = array('Post', 'User');
    public $actsAs = array('Containable');

    public function notify($id, $mentionedUserIds){
        $this->id = $id;
        $this->contain(array('Post', 'Post.User', 'User', 'Post.Room', 'Post.Room.Subscriber', 'Post.Room.Subscriber.User', 'Post.Comment', 'Post.Comment.User'));
        $comment = $this->read();

        $notifiedUsers = [];
        $notifiedUserNames = [];

        //First, notify all the room subscribers
        foreach($comment['Post']['Room']['Subscriber'] as $subscriber){
            if($subscriber['User']['active'] && $comment['Comment']['user_id'] != $subscriber['user_id']){
                $this->sendEmail(
                    $subscriber['User']['email'],
                    $comment,
                    in_array($subscriber['user_id'], $mentionedUserIds)
                );
                $notifiedUsers[] = $subscriber['user_id'];
                $notifiedUserNames[] = $subscriber['User']['display_name'];
            }
        }

        //Next, notify the original poster if they are not in the room
        if(
            $comment['Post']['User']['active'] &&
            $comment['Post']['user_id'] != $comment['Comment']['user_id'] &&
            !in_array($comment['Post']['user_id'], $notifiedUsers)
        ) {
            $this->sendEmail(
                $comment['Post']['User']['email'],
                $comment,
                in_array($comment['Post']['user_id'], $mentionedUserIds)
            );
            $notifiedUsers[] = $comment['Post']['user_id'];
            $notifiedUserNames[] = $comment['Post']['User']['display_name'];
        }

        //Notify any commenters who are not in the room
        foreach($comment['Post']['Comment'] as $otherComment) {
            if(
                $otherComment['User']['active'] &&
                $otherComment['user_id'] != $comment['Comment']['user_id'] &&
                !in_array($otherComment['user_id'], $notifiedUsers)
            ) {
                $this->sendEmail(
                    $otherComment['User']['email'],
                    $comment,
                    in_array($otherComment['user_id'], $mentionedUserIds)
                );
                $notifiedUsers[] = $otherComment['user_id'];
                $notifiedUserNames[] = $otherComment['User']['display_name'];
            }
        }

        //Finally notify mentioned users
        foreach($mentionedUserIds as $mentionedUserId) {
            if(!in_array($mentionedUserId, $notifiedUsers) && $comment['Comment']['user_id'] != $mentionedUserId) {
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'id' => $mentionedUserId
                    )
                ));
                $this->sendEmail(
                    $user['User']['email'],
                    $comment,
                    in_array($user['User']['id'], $mentionedUserIds)
                );
                $notifiedUserNames[] = $user['User']['display_name'];
            }
        }
        return $notifiedUserNames;
    }

    private function sendEmail($emailAddress, $comment, $wasUserMentioned) {
        $email = new CakeEmail();
        $email->from(array(Configure::read("Email.SenderAddress") => Configure::read("Email.SenderName")));
        $email->to($emailAddress);
        $email->template('new_comment');
        $email->emailFormat('html');
        $email->helpers(array('Html'));
        $email->subject("[Truckr] ".$comment['Post']['title']);
        $email->viewVars(array(
            'comment' => $comment,
            'urlRoot' => Configure::read("Email.UrlRoot"),
            'userWasMentioned' => $wasUserMentioned
        ));
        $email->send();
    }

}
