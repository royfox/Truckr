<?php

App::uses('Sanitize', 'Utility');

class TagsController extends AppController {

    public $name = 'Tags';
    public $components = array('Session');
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown","Gravatar");

    public function index(){
        $tags = $this->Tag->getTree();
        $this->set("tags", $tags);
    }

    public function view($slug) {
        $tag = $this->Tag->find('first', array(
            'conditions' => array(
                'Tag.slug' => $slug
            )
        ));
        if(!$tag){
            throw new NotFoundException();
        }

        $tag_ids = $this->Tag->getTagIdsWithChildren($tag['Tag']['id']);

        $postTags = $this->Tag->PostTag->find('all', array(
            'conditions' => array(
               'tag_id' => $tag_ids
            ),
            'recursive' => -1
        ));

        $post_ids = Set::extract('/PostTag/post_id', $postTags);

        $posts = $this->Tag->PostTag->Post->find('all', array(
            'contain' => array('Comment','Comment.User', 'Subscriber','Subscriber.User','User','PostTag.Tag'),
            'order' => array('modified desc'),
            'conditions' => array(
                'Post.id' => $post_ids
            )
        ));
        $this->set("breadcrumbs", $this->Tag->getBreadcrumbs($tag['Tag']['id']));
        $this->set("posts", $posts);
        $this->set("tag", $tag);
    }

    public function add() {
        $this->set("hide_navigation", true);
        if ($this->request->is('post')) {
            $this->request->data['Tag']['parent_tag_id'] = $this->request->data['Tag']['parents'];
            $this->request->data['Tag']['slug'] = $this->Tag->makeSlug($this->request->data['Tag']['name']);
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash('Your tag has been saved.', 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your tag.');
            }
        }
        $parents = $this->Tag->getSelect();
        $this->set("parents", $parents);
    }

    function edit($id = null) {
        $this->set("hide_navigation", true);
        $this->Tag->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Tag->read();
        } else {
            $this->request->data['Tag']['parent_tag_id'] = $this->request->data['Tag']['parents'];
            $this->request->data['Tag']['slug'] = $this->Tag->makeSlug($this->request->data['Tag']['name']);
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash('Your tag has been updated.', 'flash_success');
                $this->redirect(array('action' => 'view', $this->request->data['Tag']['slug']));
            } else {
                $this->Session->setFlash('Unable to update your post.', 'flash_error');
            }
        }
        $parents = $this->Tag->getSelect();
        $this->set("parents", $parents);
    }

    function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Tag->delete($id)) {
            $this->Session->setFlash('The tag has been deleted');
            $this->redirect(array('action' => 'index'));
        }
    }

}