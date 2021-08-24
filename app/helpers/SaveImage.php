<?php
namespace App\helpers;


class SaveImage{

    public static function save($image, $path)
    {
        $filename = time() . '-' . $image->getClientOriginalName();
        $fullPath = 'storage/uploads/' . $path . '/';
        if (!\File::exists($fullPath)) {
            \File::makeDirectory($fullPath, 0775, true);
        }
        $fileSavePath = $fullPath . $filename;
        \Image::make($image)->save($fileSavePath);
        return $filename;
    }

    public static function update($image, $path)
    {
//        if ($previousPath!=' '){
//            deleteFile($previousPath);
//        }
        return self::save($image, $path);
    }
}
