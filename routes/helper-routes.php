<?php

use Nurmuhammet\Helpers\Http\Controllers\Api\AppVersion\AppVersionController;

if (config('helpers.api.app_versions.enabled')) 
{
    Route::get(
        uri: config('helpers.api.app_versions.route_path'), 
        action: [AppVersionController::class, 'checkForUpdate']
    );
}
