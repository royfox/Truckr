<?php

App::uses('Sanitize', 'Utility');

class CategoriesController extends AppController {

    public $name = 'Categories';
    public $components = array('Session');
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown","Gravatar");

    public function index(){
        $categories = $this->Category->find('all', array(
            'order' => array('name asc'),
            'recursive' => 2
        ));
        $this->set("categories", $categories);
    }

    public function view($slug){
        $category = $this->Category->find('first', array(
            'conditions' => array(
                'Category.slug' => $slug
            )
        ));
        if(!$category){
            throw new NotFoundException();
        }

        $categoryTags = $this->Category->CategoryTag->find('all', array(
            'conditions' => array(
               'category_id' => $category['Category']['id']
            ),
            'recursive' => -1
        ));

        $tag_ids = Set::extract('/CategoryTag/tag_id', $categoryTags);

        $postTags = $this->Category->CategoryTag->Tag->PostTag->find('all', array(
            'conditions' => array(
               'tag_id' => $tag_ids
            ),
            'recursive' => -1
        ));

        $post_ids = Set::extract('/PostTag/post_id', $postTags);

        $posts = $this->Category->CategoryTag->Tag->PostTag->Post->find('all', array(
            'contain' => array('Comment','Comment.User', 'Subscriber','Subscriber.User','User','PostTag.Tag','Status'),
            'order' => array('modified desc'),
            'conditions' => array(
                'Post.id' => $post_ids
            )
        ));
        $this->set("posts", $posts);
        $this->set("category", $category);

    }

}