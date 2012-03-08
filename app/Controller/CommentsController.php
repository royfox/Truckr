<?php

App::uses('Sanitize', 'Utility');

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