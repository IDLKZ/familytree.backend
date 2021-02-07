<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    public static function saveImage($file, $directory){
        $filename = Str::random(12) . "." . $file->getClientOriginalExtension();
        $file->storeAs($directory,$filename);
        return $directory . $filename;
    }

    public static function deleteImage($file){
        if(Storage::exists($file) && $file != "/no-image.png" ){
            Storage::delete($file);
        }
    }
}
