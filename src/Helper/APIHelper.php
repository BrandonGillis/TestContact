<?php

namespace App\Helper;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

abstract class APIHelper
{
    public function generateError(int $code, array $errors = [])
    {
        return View::create(
            [
                "code" => $code,
                "message" => Response::$statusTexts[$code],
                "errors" => [
                    "errors" => $errors
                ]
            ],
            $code
        );
    }
}