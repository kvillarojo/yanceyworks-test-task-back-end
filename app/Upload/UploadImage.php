<?php


namespace App\Upload;


use App\Traits\Upload\FileUpload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UploadImage
{
    use FileUpload;

    private $image;
    private $upload_dir;
    private $filepath;
    private $filename;

    public function __construct($request)
    {
        $this->image = $request;
        $this->filename = Carbon::now() . '.' . $this->image->file('img')->getClientOriginalExtension();
    }

    public function upload(): void
    {

        $image = $this->image->file('img');

        if ($this->exist()) {
            throw new \RuntimeException('File already exists', 409);
        }

        $this->uploadImg(
            $image,
            $this->getUploadDir(),
            'local',
            $this->getFileName()
        );
    }

    public function setUploadDir($dir){
        $this->upload_dir = $dir;
    }

    public function getUploadDir(){
        return $this->upload_dir;
    }

    public function getFileName() {
        return $this->filename ;
    }

    public function getFilePath(): string
    {
        return $this->getUploadDir() . '/' . $this->getFileName();
    }

    public function delete(): void
    {
        Storage::disk('local')->delete($this->getFilePath());
    }

    public function exist(): bool
    {
        return Storage::disk('local')->exists($this->getfilePath());
    }
}
