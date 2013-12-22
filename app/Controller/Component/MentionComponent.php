<?php


class MentionComponent  extends Component {

    function __construct(ComponentCollection $collection, $settings = array()) {
        parent::__construct($collection, $settings);
    }

    public function getMentionedUserIds($content, $users){
        $mentionedNames = $this->getUsernames($content);
        $validUsers = array();
        foreach($users as $user){
            if(in_array($user['User']['username'], $mentionedNames)){
                $validUsers[] = $user['User']['id'];
            }
        }
        return $validUsers;
    }

    public function getUsernames($content){
        $regex = '/(?:^|[^a-zA-Z0-9.])@([A-Za-z]+[A-Za-z0-9]+)/';
        preg_match_all($regex, $content, $output);
        if(isset($output[1])){
            return $output[1];
        } else {
            return array();
        }
    }

}