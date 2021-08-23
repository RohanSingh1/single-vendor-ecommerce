<?php


namespace App\helpers;

class CheckExistingUrl
{
    public static function check($classPath, $title, $previousUrl)
    {
        $temp = createPostSlug($title);
        if (!($classPath::where('url', $temp)->withTrashed()->get()->isEmpty())) {
            $i = 1;
            $newslug = $temp . '-' . $i;
            while (!($classPath::where('url', $newslug)->where('url','!=', $previousUrl)->withTrashed()->get()->isEmpty())) {
                $i++;
                $newslug = $temp . '-' . $i;
            }
            $temp = $newslug;
        }
        return url($temp);
    }
}
