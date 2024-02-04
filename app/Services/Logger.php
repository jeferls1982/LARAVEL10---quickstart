<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class Logger
{
    public static function debug(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function info(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function notice(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function warning(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function error(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function critical(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function alert(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function emergency(string $message, array $context = [])
    {
        $action = __FUNCTION__;
        self::store($action, $message, $context);
    }

    public static function store($action, $message, $context)
    {
        $user = Auth::user();
        $method = debug_backtrace()[2]['class']."::".debug_backtrace()[2]['function'];
        if($user) {
            Log::$action("User {$user->id} ({$user->email}) | {$method} | {$message}", array_merge($context, ['ip' => request()->ip()]));
        } else {
            Log::$action("IP " . request()->ip() . " | {$method} | {$message}", [$context]);
        }
    }
}
