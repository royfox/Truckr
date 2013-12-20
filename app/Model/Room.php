<?php

class Room extends AppModel {
    public $actsAs = array('Containable');
    public $name = 'Room';
    public $hasMany = array('Post');
}
