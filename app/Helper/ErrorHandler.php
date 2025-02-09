<?php

namespace App\Helper;

use App\Models\ErrorLog;
use Illuminate\Support\Facades\Auth;

class ErrorHandler
{
    public static function record($record, $method)
    {
        try {
            if ($record instanceof \PDOException && property_exists($record, 'errorInfo')) {
                if ($method === 'response') {
                    return FormatResponse::send("error", null, $record->errorInfo, 400);
                } else {
                    return redirect()->back()->withErrors(['error' => $record->errorInfo]);
                }
            } else {
                if ($method === 'response') {
                    return FormatResponse::send("error", null, $record->getMessage(), 400);
                } else {
                    return redirect()->back()->withErrors(['error' => $record->getMessage()]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
