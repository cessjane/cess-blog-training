<?php

namespace App\Components;

trait FlashMessages
{
    protected static function message($level = 'info', $message = null, $color = 'blue')
    {
        session()->flash('message', $message);
        session()->flash('color', $color);

        return $message;
    }

    protected static function messages()
    {
        return self::hasMessages() ? session()->pull('messages') : [];
    }

    protected static function hasMessages()
    {
        return session()->has('messages');
    }

    protected static function success($message)
    {
        return self::message('success', $message, 'green');
    }

    protected static function info($message)
    {
        return self::message('info', $message, 'blue');
    }

    protected static function warning($message)
    {
        return self::message('warning', $message, 'yellow');
    }

    protected static function danger($message)
    {
        return self::message('danger', $message, 'red');
    }
}