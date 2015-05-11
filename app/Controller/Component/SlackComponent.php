<?php

class SlackComponent extends Component {

    public function newPost($post) {
        $this->send($post, "posted", $post['User']['display_name']);
    }

    public function newComment($post, $userName) {
        $this->send($post, "added a comment to", $userName);
    }

    private function send($post, $context, $userName) {
        $slackUrl = Configure::read('Slack.Url');
        if($slackUrl) {
            $postLink = '<' . Configure::read('Email.UrlRoot') . '/posts/view/' . $post['Post']['id'] . '|' . $post['Post']['title'] . '>';
            $roomLink = '<' . Configure::read('Email.UrlRoot') . '/rooms/view/' . $post['Room']['id'] . '|' . $post['Room']['name'] . '>';
            $slackMessage = "$userName $context $postLink in the room $roomLink";
            $channel = (strpos($post['Room']['slack_channel'], '#') === false) ?  Configure::read('Slack.DefaultChannel') : trim($post['Room']['slack_channel']);
            $settings = [
                'username' => 'Truckr',
                'channel' => $channel,
                'link_names' => true
            ];
            $client = new Maknz\Slack\Client(Configure::read('Slack.Url'), $settings);
            $message = $client->createMessage();
            $message->send($slackMessage);
        }
    }
}
