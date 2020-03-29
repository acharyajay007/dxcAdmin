<?php 
namespace App\Traits;
use Image;
use Storage;

trait CommonTrait {
 
    public function storeImage($image, $folder) {
        $fileName   = time() . '.' . $image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->stream();
        Storage::disk('local')->put($folder.'/'.$fileName, $img, 'public');
        return $fileName;
    }
    public function deleteImage($image, $folder) {
        return Storage::disk('local')->delete($folder.'/'.$image);
    }

    public function getPath($image, $folder) {
        return  Storage::disk('local')->url($folder.'/'.$image);
    } 
    public function getDefaultImagePath() {
        return  Storage::disk('local')->url('default/default.png');
    }
 
}
 