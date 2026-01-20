<?php

namespace App\Exceptions;

use Exception;

class CheckOutException extends Exception
{
    public function render()
    {
        return redirect()->route('home')->withErrors($this->getMessage())->with('update', $this->getMessage());
    }
}
