<?php

namespace App\Common;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class Helper
{
    /**
     * @param $result
     * @param $errorMessage
     * @param int|null $status
     * @return Application|ResponseFactory|Response
     */
    public static function getResponse($result, $errorMessage = null, int $status = null, $total_page=null)
    {
        if ($result) {
            return response([
                'success' => $result,
                'total_page' =>  $total_page
            ], $status ?? 200);
        } else {
            return response([
                'error' => $errorMessage ?? 'Please try again'
            ], $status ?? 400);
        }
    }

    public static function RandomString($length=10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
