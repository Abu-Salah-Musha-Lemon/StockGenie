<?php

/*
|--------------------------------------------------------------------------
| IMAGE VALIDATION
|--------------------------------------------------------------------------
*/

if (!function_exists('validate_image')) {

    function validate_image($file): bool
    {
        if (!$file) {
            return false;
        }

        $mime = $file->getMimeType();

        $allowedMimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
        ];

        return in_array($mime, $allowedMimes, true);
    }
}


/*
|--------------------------------------------------------------------------
| DELETE FILE
|--------------------------------------------------------------------------
*/

if (!function_exists('delete_file')) {

    function delete_file(?string $filePath): void
    {
        if (
            $filePath &&
            file_exists(public_path($filePath))
        ) {
            unlink(public_path($filePath));
        }
    }
}


/*
|--------------------------------------------------------------------------
| UPLOAD IMAGE
|--------------------------------------------------------------------------
*/

if (!function_exists('upload_image')) {

    function upload_image(
        $file,
        string $folder = 'uploads',
        int $maxWidth = 500,
        int $maxHeight = 500,
        int $quality = 80
    ): ?string {

        if (!$file) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Validate
        |--------------------------------------------------------------------------
        */

        if (!validate_image($file)) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Create directory
        |--------------------------------------------------------------------------
        */

        $uploadPath = public_path($folder);

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        /*
        |--------------------------------------------------------------------------
        | MIME
        |--------------------------------------------------------------------------
        */

        $mime = $file->getMimeType();

        /*
        |--------------------------------------------------------------------------
        | Create source image
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

            case 'image/jpeg':
                $source = imagecreatefromjpeg(
                    $file->getPathname()
                );
                break;

            default:
                return null;
        }

        if (!$source) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Original size
        |--------------------------------------------------------------------------
        */

        $origWidth = imagesx($source);
        $origHeight = imagesy($source);

        /*
        |--------------------------------------------------------------------------
        | Resize without enlarging small images
        |--------------------------------------------------------------------------
        */

        $ratio = min(
            1,
            $maxWidth / $origWidth,
            $maxHeight / $origHeight
        );

        $newWidth = max(
            1,
            (int) ($origWidth * $ratio)
        );

        $newHeight = max(
            1,
            (int) ($origHeight * $ratio)
        );

        /*
        |--------------------------------------------------------------------------
        | Create new image
        |--------------------------------------------------------------------------
        */

        $newImage = imagecreatetruecolor(
            $newWidth,
            $newHeight
        );

        /*
        |--------------------------------------------------------------------------
        | White background
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
        | Resize
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
        | Filename
        |--------------------------------------------------------------------------
        */

        $fileName =
            time() .
            '_' .
            uniqid() .
            '.webp';

        /*
        |--------------------------------------------------------------------------
        | Path
        |--------------------------------------------------------------------------
        */

        $relativePath =
            $folder . '/' . $fileName;

        $savePath =
            public_path($relativePath);

        /*
        |--------------------------------------------------------------------------
        | Save WebP
        |--------------------------------------------------------------------------
        */

        imagewebp(
            $newImage,
            $savePath,
            $quality
        );

        /*
        |--------------------------------------------------------------------------
        | Memory cleanup
        |--------------------------------------------------------------------------
        */

        imagedestroy($source);
        imagedestroy($newImage);

        return $relativePath;
    }
}
