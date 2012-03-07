<?php

class Category extends AppModel {

    public $name = 'Category';
    public $hasMany = array('Post');
}