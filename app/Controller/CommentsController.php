<?php

App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class CommentsController extends AppController {

    public $name = 'Comments';
    public $components = array('Session');

    public function add($post_id) {
        if ($this->request->is('post')) {
            $post = $this->Comment->Post->find('first', array(
                'conditions' => array('Post.id' => $post_id)
            ));
            if(!$post){
                throw new NotFoundException();
            }
            if ($this->Comment->save($this->request->data)) {
                $this->Comment->set('user_id', $this->Auth->user('id'));
                $this->Comment->set('post_id', $post_id);
                $this->Comment->save();

                //add the user to the list of subscribers, if they are not there already
                $subscriber = $this->Comment->Post->Subscriber->find('first', array(
                    'conditions' => array(
                        'Subscriber.user_id' => $this->Auth->user('id'),
                        'Subscriber.post_id' => $post_id
                )));
                if(!$subscriber){
                    $this->Comment->Post->Subscriber->create();
                    $this->Comment->Post->Subscriber->save(array(
                        'post_id' => $post_id,
                        'user_id' => $this->Auth->user('id')
                    ));
                }
                $this->Comment->notify($this->Comment->id);
                $this->Session->setFlash('Your comment has been saved.');
                $this->redirect(array('controller'=>'posts','action' => 'view', $post_id));
            } else {
                $this->Session->setFlash('Unable to add your comment');
            }
        }
    }
    function delete($id, $post_id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Comment->delete($id)) {
            $this->Session->setFlash('The comment has been deleted');
            $this->redirect(array('controller'=>'posts','action' => 'view', $post_id));
        }
    }
}