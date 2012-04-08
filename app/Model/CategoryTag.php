<?php

class CategoryTag extends AppModel {

    public $name = 'CategoryTag';
    public $belongsTo = array('Category', 'Tag');
}