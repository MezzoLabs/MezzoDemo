<?php


namespace App\Html;


use App\ContentBlock;
use Carbon\Carbon;

class HtmlHelper
{
    public function embeddedWebVideo($url)
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

    public function timeSpan(Carbon $day1, Carbon $day2)
    {
        if ($day1->format('Y-m-d') == $day2->format('Y-m-d')) {
            return $day1->format('d.m.Y ' . $day1->format('h:i') . ' - ' . $day2->format('h:i'));
        }

        return $day1->format('d.m.Y h:i') . ' - ' . $day2->format('d.m.Y h:i');

    }
}