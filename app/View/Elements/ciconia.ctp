<?php

use Ciconia\Common\Text;
use Ciconia\Extension\Custom;
use Ciconia\Extension\Gfm;

$ciconia = new \Ciconia\Ciconia();

$ciconia->addExtension(new Gfm\FencedCodeBlockExtension());
$ciconia->addExtension(new Gfm\TaskListExtension());
$ciconia->addExtension(new Gfm\InlineStyleExtension());
$ciconia->addExtension(new Gfm\WhiteSpaceExtension());
$ciconia->addExtension(new Gfm\TableExtension());
$ciconia->addExtension(new Gfm\UrlAutoLinkExtension());
$ciconia->addExtension(new Custom\MentionExtension());

if(strlen(trim($content)) == 0){
    echo "Nothing to display";
} else {
    /**
     * Emoji processing: couldn't make this work as a Ciconia extension, as it
     * kept doing something funny with underscores in the image URL, or
     * replacing the image URL with a link
     */
    $content = $ciconia->render($content);
    $text = new Text($content);
    $text->replace('/:\S*:/', function(Text $w){
        $name = str_replace(":", "", $w);
        $url = Router::url('/', true)."img/emoji/$name.png";
        return "<img src = '$url' class='emoji' />";
    });
    echo $text->getString();
}

?>


