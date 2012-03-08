<?php

App::uses('Sanitize', 'Utility');

class SubjectsController extends AppController {

    public $name = 'Subjects';
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown");
    public $components = array('Session');

    public function view($slug) {
        $subject = $this->Subject->find('first', array(
            'conditions' => array('Subject.slug' => $slug)
        ));
        if(!$subject){
            throw new NotFoundException();
        }
        $this->set("subject", $subject);
        $this->set('posts', $this->Subject->Post->find('all',array(
             'order' => array('modified desc'),
             'conditions' => array(
                'Subject.slug' => $slug
             )
        )));
    }
}