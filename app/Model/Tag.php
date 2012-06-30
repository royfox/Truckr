<?php

class Tag extends AppModel {

    public $name = 'Tag';
    public $hasMany = array('PostTag');

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


    public function getSelect(){
        $tree = $this->getTree();
        $select = $this->addToSelect($tree[0], array(), "");
        return $select;
    }

    private function addToSelect($tree, $select, $prefix){
        $name = $prefix ? $prefix." > ".$tree['name'] : $tree['name'];
        $select[$tree['id']] = $name;
        if(isset($tree['children'])){
            foreach($tree['children'] as $child){
                $select = $this->addToSelect($child, $select, $tree['id'] == 0 ? "" : $name);
            }
        }
        return $select;
    }

    public function getTree(){

        $tags = $this->find('all',array(
            'recursive' => -1
        ));

        //create empty list with root node
        $list = array('-1' => array(array('name' => 'No parent', 'id' => 0)));

        //create hash by parent id
        foreach($tags as $tag){
            $list[$tag['Tag']['parent_tag_id']][] = $tag['Tag'];
        }

        //recursively build tree, passing in root node to begin
        $tree = $this->createTree($list, array($list[-1][0]), 0);

        usort($tree[0]['children'], function($a, $b) {
            return strcmp($a['name'], $b['name']);
         });

        return $tree;

    }

    private function createTree(&$list, $parent, $level){
        $tree = array();
        foreach ($parent as $l){
            if(isset($list[$l['id']])){
                $l['children'] = $this->createTree($list, $list[$l['id']], $level + 1);
            }
            $l['level'] = $level;
            $tree[] = $l;
        }
        return $tree;
    }



}