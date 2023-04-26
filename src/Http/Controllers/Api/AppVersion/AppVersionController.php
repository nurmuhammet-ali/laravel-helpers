<?php

namespace Nurmuhammet\Helpers\Http\Controllers\Api\AppVersion;

use Illuminate\Routing\Controller;
use Nurmuhammet\Helpers\Http\Requests\Api\AppVersion\CheckForUpdateRequest;

class AppVersionController extends Controller
{
    /**
     * Check for app updates
     * @param  \Nurmuhammet\Helpers\Http\Requests\Api\AppVersion\CheckForUpdateRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkForUpdate(CheckForUpdateRequest $request) 
    {
        $app_version = AppVersion::latest()->where('device', $request->device)->first();

        if ((int) $request->version == (int) $app_version->version) {
            return $this->latestVersionResponse();
        }

        if ((int) $request->version < (int) $app_version->version && $app_version->important) {
            return $this->requiredToUpdateResponse();
        }

        if ((int) $request->version < (int) $app_version->version) {
            return $this->optionalToUpdateResponse();
        }
    }

    /**
     * Latest version
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function latestResponse()
    {
        return response()->json(['update' => 'latest']);
    }

    /**
     * Required to update
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function requiredToUpdateResponse()
    {
        return response()->json(['update' => 'required']);
    }

    /**
     * Update not required, but should be
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function optionalToUpdateResponse()
    {
        return response()->json(['update' => 'optional']);
    }
}
