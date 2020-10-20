<?php

namespace App\Traits\Upload;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

trait FileUpload
{
    /**
     * @param UploadedFile $uploadedFile
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadImg(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);
        return $uploadedFile->storeAs($folder, $name, $disk);
    }
}

