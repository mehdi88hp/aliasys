<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    public function fileFinalPath($filePath)
    {
//        if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
//            return public_path($filePath);;
//        } else {
            return $_SERVER['DOCUMENT_ROOT'] . '/club' . $filePath;
//        }
    }

    public function __construct()
    {
        ini_set('upload_max_filesize', '2055');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


}
