<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogger
{
    public static function log(
        string $action,
        string $model = null,
        int $modelId = null,
        array $data = []
    ): void {
        $request = app(Request::class);

        ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => $action,
            'model'      => $model,
            'model_id'   => $modelId,
            'data'       => $data,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}