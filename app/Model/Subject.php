<?php

class Subject extends AppModel {

    public $name = 'Subject';
    public $hasMany = array('Post');
}