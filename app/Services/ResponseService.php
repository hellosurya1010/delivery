<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;

class ResponseService {
    use ResponseTrait;

    public function code($code)
    {
        $this->code = $code;
        return $this;
    }

    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    public function errors($boolean)
    {
        $this->errors = $boolean;
        return $this;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function devMessage($message)
    {
        $this->devMessage = ['message' => $message];
        return $this;
    }

    public function getResponse()
    {
        return $this->sendApiResponse();
    }

}