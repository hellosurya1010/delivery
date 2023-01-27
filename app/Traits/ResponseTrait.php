<?php

namespace App\Traits;

trait ResponseTrait
{

    public $errors = false;
    public $uriError = false;
    public $message = 'Successfully';
    public $devMessage = ['message' => 'No errors'];
    public $code = 200;
    public $data = [];
    public $apiResponseActivated = false;



    public function sendErrorResponse($msg)
    {
        $this->devMessage = ['message' => $msg];
        return ['message' => $this->message, 'dev-message' => $this->devMessage, 'data' => $this->data, 'errors' => $this->errors];
    }

    public function setDevMessage($message)
    {
        $this->setCode(500);
        $this->setError(true);
        $this->setMessage('Something went wrong try again later!.');
        if (is_string($message)) {
            $this->devMessage = $message;
        }
        if (is_object($message)) {
            $e = $message;
            $this->devMessage  = ['message' => $e->getMessage(), 'file_path' => $e->getFile(),  'line_no' => $e->getLine()];
        }
    }

    public function setCode($code)
    {
        $this->code = $code;
    }
    public function setError($boolean)
    {
        $this->errors = $boolean;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }


    function setUriError()
    {
        $this->uriError = true;
        $this->errors = true;
        $this->setDevMessage('URI error');
    }

    public function sendApiResponse()
    {
        return response()
            ->json([
                'message' => $this->message,
                'dev-message' => $this->devMessage,
                'data' => $this->data,
                'errors' => $this->errors
            ], $this->code)
            ->withHeaders([
                'Accept' => 'application/json',
            ]);
    }
}
