<?php

use Ciconia\Extension\Gfm;

$ciconia = new \Ciconia\Ciconia();
$ciconia->addExtension(new Gfm\FencedCodeBlockExtension());
$ciconia->addExtension(new Gfm\TaskListExtension());
$ciconia->addExtension(new Gfm\InlineStyleExtension());
$ciconia->addExtension(new Gfm\WhiteSpaceExtension());
$ciconia->addExtension(new Gfm\TableExtension());
$ciconia->addExtension(new Gfm\UrlAutoLinkExtension());

if(strlen(trim($content)) == 0){
    echo "Nothing to display";
} else {
    echo $ciconia->render($content);
}

?>


