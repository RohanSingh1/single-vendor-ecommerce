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
        if($image->getClientOriginalExtension() == 'svg'){
            $image->storeAs(
                'uploads/'.$path, $filename
            );
        }else{
            \Image::make($image)->save($fileSavePath);
        }

        return $filename;
    }

    public static function update($image, $path,$previousPath=null)
    {
       if ($previousPath!=' '){
           deleteFile($previousPath);
       }
        return self::save($image, $path);
    }
}
