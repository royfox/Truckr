<?php

class Category extends AppModel {

    public $name = 'Category';
    public $hasMany = array('CategoryTag');

    public $validate = array(
        'slug' => array(
            'rule'    => 'isUnique',
            'message' => 'This name already exists.'
        )
    );

    public function makeSlug($name, $maxLength = 50){
       $result = strtolower($name);
       $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
       $result = trim(preg_replace("/[\s-]+/", " ", $result));
       $result = trim(substr($result, 0, $maxLength));
       $result = preg_replace("/\s/", "-", $result);
       return $result;
    }

}