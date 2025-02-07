<?php

namespace App\Helpers;

class File
{
    public static function upload($file, $outputPath = "uploads/")
    {
        if (!is_dir($outputPath)) {
            mkdir($outputPath, 0755, true);
        }
        $fileName = time() . "_" . trim(basename($file["name"]));
        $upload_path = $outputPath . $fileName;
        move_uploaded_file($file["tmp_name"], $upload_path);

        return $upload_path;
    }

    public static function delete($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
    }
}
