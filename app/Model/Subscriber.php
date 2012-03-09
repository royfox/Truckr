<?php

class Subscriber extends AppModel {

    public $name = 'Subscriber';
    public $belongsTo = array('Post','User');
}