<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     anacreation\workflow
 * @Date        : 16/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Anacreation\Organization\Http\Api;

use Anacreation\Organization\Entities\Organization;
use Anacreation\Organization\Http\Resources\OrganizationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(OrganizationResource::collection(Organization::all()));
    }
}
