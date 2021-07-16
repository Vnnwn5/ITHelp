<?php


namespace App\Traits;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


trait UploadImage
{
    protected $new_name;
    protected $allowed_extensions=['jpg','jpeg','png','gif'];
    protected $error_message='';

    public function upload($file, $prefix='' , $disk= 'public')
    {
            $extension = strtolower($file->getClientOriginalExtension());

            if(!$this->validateFile($file, $extension)){
                return false;
            }

        $this->new_name = uniqid($prefix, true).'.'.$extension;
        $result = Storage::disk($disk)->put('avatars/'.$this->new_name, File::get($file));

        if(!$result){
            $this->error_message = 'Ha ocurrido un error al subir el archivo'. $file
                    ->getClientOriginalName();
            return false;
        }
        return true;
    }
    public function validateFile($file,$extension)
    {
        if($file->getError()){
            $this->error_message = 'Error de archivo, esta corrupto o excede el tamanio permitido.Verifica'. $file
                    ->getClientOriginalName();
        }elseif (!in_array($extension, $this->allowed_extensions)){
            $this->error_message = 'Extencion invalida del archivo'. $file
                    ->getClientOriginalName();

        }elseif ($file->getSize() > 1000000){
            $this->error_message ='El archivo excede el tamanio maximo, verifica'. $file
                    ->getClientOriginalName();
        }
        if (!empty($this->error_message)){
            return false;
        }
        return true;
    }
}
