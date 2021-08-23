<?php

namespace App\helpers;


class CheckExistingSlug
{
    public static function check($classPath, $title, $previousSlug='')
    {
        $temp = createPostSlug($title);
        if (!($classPath::where('slug', $temp)->where('slug','!=', $previousSlug)->withTrashed()->get()->isEmpty())) {
            $i = 1;
            $newslug = $temp . '-' . $i;
            while (!($classPath::where('slug', $newslug)->withTrashed()->get()->isEmpty())) {
                $i++;
                $newslug = $temp . '-' . $i;
            }
            $temp = $newslug;
        }
        return $temp;
    }

}
