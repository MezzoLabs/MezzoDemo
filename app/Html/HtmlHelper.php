<?php


namespace App\Html;


use App\ContentBlock;

class HtmlHelper
{
    public static function embeddedWebVideo($url)
    {
        if($url instanceof ContentBlock){
            $url = $url->getFieldValue('url');
        }




        if(preg_match('|vimeo\.com\/([1-9]+)|', $url, $matches)){
            return '<iframe src="https://player.vimeo.com/video/'. $matches[1] .'" width="500" height="281" ' .
            'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }

        return 'video provider not found';



    }
}