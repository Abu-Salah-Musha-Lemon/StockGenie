<?php

namespace App\Services\Product;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductImageService
{
    public function upload(UploadedFile $file): string
    {
        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('products', $name, 'public');

        return $name;
    }
}
