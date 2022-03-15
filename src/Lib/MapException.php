<?php

namespace Magein\Map\Lib;

use Exception;

class MapException
{
    protected string $message = '';

    protected int $code = 1;

    /**
     * @param string $message
     * @param int $code
     * @throws Exception
     */
    public function __construct(string $message, int $code = 1)
    {
        $this->message = $message;
        $this->code = $code;
        $this->throwException();
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @throws Exception
     */
    protected function throwException()
    {
        $debug = config('map.debug');
        if ($debug) {
            throw new Exception($this->message, $this->code);
        }
    }
}