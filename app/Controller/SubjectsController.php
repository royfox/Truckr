<?php

App::uses('Sanitize', 'Utility');

class SubjectsController extends AppController {

    public $name = 'Subjects';
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown");
    public $components = array('Session');

    public function view($slug) {
        $this->set("subject", $this->Subject->find('first', array(
            'conditions' => array('Subject.slug' => $slug)
        )));
        $this->set('posts', $this->Subject->Post->find('all',array(
             'order' => array('modified desc'),
             'conditions' => array(
                'Subject.slug' => $slug
             )
        )));
    }

}