<?php 

namespace App\Http\Controllers\Traits;

Trait ExcelUpload
{
    private function storeExcel($file, $folder)
    {
        if (env('APP_ENV') == 'production') {
            return $this->localExcelUpload($file, $folder);
        }

        // if local use this for default
        return $this->localExcelUpload($file, $folder);
    }

    private function localExcelUpload($file, $folder)
    {
        // get file extension
        $extension = $file->getClientOriginalExtension();

        // your file destination 
        $directoryTarget = 'excel/' . $folder;

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