<?php

class PostTag extends AppModel {

    public $name = 'PostTag';
    public $belongsTo = array('Post', 'Tag');

    public function getTagCount($criteria = array()){

        $findCriteria = array(
            'contain' => array("Tag", "PostTag"),
            'group' => 'tag_id',
            'fields' => 'Tag.name, Tag.slug, Tag.id, COUNT(*) as count',
            'order' => 'count desc'
        );

        foreach($criteria as $key => $value){
            $findCriteria[$key] = $value;
        }

        return $this->find('all', $findCriteria);
    }
}