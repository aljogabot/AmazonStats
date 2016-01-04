<?php

namespace AmazonStats\Handlers\ResponseHandlers;

use Response;

/**
 * Json Response Handler ...
 */
class JsonResponse
{
    private $data = [];

    public function __construct()
    {
        /**
         * Initialize success to FALSE ...
         */
        $this->data[ 'success' ] = false;
    }

    public function set($key, $value)
    {
        $this->data[ $key ] = $value;
        return $this;
    }

    public function redirect( $url )
    {
        $this->set( 'redirect', $url );
        return $this;
    }

    public function error($message = '')
    {
        $this->data[ 'message' ] = $message;
        return $this->render();
    }

    public function success($message = '')
    {
        $this->data[ 'success' ] = true;
        $this->data[ 'message' ] = $message;
        return $this->render();
    }

    public function render()
    {
        return Response::json($this->data);
    }
}
