<?php 

namespace App\Http\Controllers\Traits;

Trait ImageUpload
{
    private function storeImages($file, $folder)
    {
        if (env('APP_ENV') == 'production') {
            return $this->localImageUpload($file, $folder);
        }

        // if local use this for default
        return $this->localImageUpload($file, $folder);
    }

    private function localImageUpload($file, $folder)
    {
        // get file extension
        $extension = $file->getClientOriginalExtension();

        // your file destination 
        $directoryTarget = 'images/' . $folder;

        //unique name for file 
        $filename = uniqid() . '.' . $extension;

        //finnaly move file to your destination
        $file->move($directoryTarget, $filename);

        /** will output
         * http://localhost:8000/ + directory target + filename
         */
        return url('/') . '/' . $directoryTarget . '/' . $filename;
    }
}

?>