<?php

/*
|--------------------------------------------------------------------------
| IMAGE VALIDATION
|--------------------------------------------------------------------------
*/

if (!function_exists('validate_image')) {

    function validate_image($file)
    {
        if (!$file) {
            return false;
        }

        $mime = $file->getMimeType();

        $allowedMimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp'
        ];

        return in_array($mime, $allowedMimes);
    }
}

/*
|--------------------------------------------------------------------------
| DELETE FILE
|--------------------------------------------------------------------------
*/

if (!function_exists('delete_file')) {

    function delete_file($filePath)
    {
        if ($filePath && file_exists(public_path($filePath))) {

            unlink(public_path($filePath));
        }
    }
}

/*
|--------------------------------------------------------------------------
| UPLOAD IMAGE
|--------------------------------------------------------------------------
|
| Features:
| - Validate image
| - Resize with aspect ratio
| - Compress image
| - Convert to WebP
| - Fast loading optimized
|
*/

if (!function_exists('upload_image')) {

    function upload_image(
        $file,
        $folder = 'uploads',
        $maxWidth = 300,
        $maxHeight = 300,
        $quality = 80
    ) {

        /*
        |--------------------------------------------------------------------------
        | CHECK FILE
        |--------------------------------------------------------------------------
        */

        if (!$file) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE IMAGE
        |--------------------------------------------------------------------------
        */

        if (!validate_image($file)) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE DIRECTORY
        |--------------------------------------------------------------------------
        */

        $uploadPath = public_path($folder);

        if (!file_exists($uploadPath)) {

            mkdir($uploadPath, 0777, true);
        }

        /*
        |--------------------------------------------------------------------------
        | MIME TYPE
        |--------------------------------------------------------------------------
        */

        $mime = $file->getMimeType();

        /*
        |--------------------------------------------------------------------------
        | CREATE IMAGE RESOURCE
        |--------------------------------------------------------------------------
        */

        switch ($mime) {

            case 'image/png':

                $source = imagecreatefrompng(
                    $file->getPathname()
                );

                break;

            case 'image/gif':

                $source = imagecreatefromgif(
                    $file->getPathname()
                );

                break;

            case 'image/webp':

                $source = imagecreatefromwebp(
                    $file->getPathname()
                );

                break;

            default:

                $source = imagecreatefromjpeg(
                    $file->getPathname()
                );

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK SOURCE
        |--------------------------------------------------------------------------
        */

        if (!$source) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | ORIGINAL IMAGE SIZE
        |--------------------------------------------------------------------------
        */

        $origWidth  = imagesx($source);

        $origHeight = imagesy($source);

        /*
        |--------------------------------------------------------------------------
        | ASPECT RATIO
        |--------------------------------------------------------------------------
        */

        $ratio = min(
            $maxWidth / $origWidth,
            $maxHeight / $origHeight
        );

        /*
        |--------------------------------------------------------------------------
        | NEW SIZE
        |--------------------------------------------------------------------------
        */

        $newWidth = (int) ($origWidth * $ratio);

        $newHeight = (int) ($origHeight * $ratio);

        /*
        |--------------------------------------------------------------------------
        | CREATE NEW IMAGE
        |--------------------------------------------------------------------------
        */

        $newImage = imagecreatetruecolor(
            $newWidth,
            $newHeight
        );

        /*
        |--------------------------------------------------------------------------
        | WHITE BACKGROUND
        |--------------------------------------------------------------------------
        */

        $white = imagecolorallocate(
            $newImage,
            255,
            255,
            255
        );

        imagefill(
            $newImage,
            0,
            0,
            $white
        );

        /*
        |--------------------------------------------------------------------------
        | RESIZE IMAGE
        |--------------------------------------------------------------------------
        */

        imagecopyresampled(
            $newImage,
            $source,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        /*
        |--------------------------------------------------------------------------
        | FILE NAME
        |--------------------------------------------------------------------------
        */

        $fileName =
            time() .
            '_' .
            uniqid() .
            '.webp';

        /*
        |--------------------------------------------------------------------------
        | SAVE PATH
        |--------------------------------------------------------------------------
        */

        $relativePath =
            $folder . '/' . $fileName;

        $savePath =
            public_path($relativePath);

        /*
        |--------------------------------------------------------------------------
        | SAVE WEBP IMAGE
        |--------------------------------------------------------------------------
        */

        imagewebp(
            $newImage,
            $savePath,
            $quality
        );

        /*
        |--------------------------------------------------------------------------
        | CLEAR MEMORY
        |--------------------------------------------------------------------------
        */

        imagedestroy($source);

        imagedestroy($newImage);

        /*
        |--------------------------------------------------------------------------
        | RETURN PATH
        |--------------------------------------------------------------------------
        */

        return $relativePath;
    }
}