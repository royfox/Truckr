<?php

class PostTag extends AppModel {

    public $name = 'PostTag';
    public $belongsTo = array('Post', 'Tag');
}