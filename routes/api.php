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
 * @package     ${PACKAGE}
 * @Date        : 16/10/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

use Anacreation\Workflow\Entities\Workflow;
use Anacreation\Workflow\Http\Api\WorkflowController;
use Anacreation\Workflow\Http\Api\WorkflowStateController;
use Anacreation\Workflow\Http\Api\WorkflowTransitionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::group([
                 'middleware' => 'api',
                 'prefix'     => 'api',
             ],
    function() {


        Route::group([
                         'middleware' => config('organization.route.middleware',
                                                []),
                         'prefix'     => config('organization.route.prefix',
                                                ''),
                     ],
            function() {


                Route::get('/workflows',
                           OrganizationController::class."@index");
                Route::put('/workflows/{workflow}',
                           OrganizationController::class."@update");
                Route::delete('/workflows/{workflow}',
                              OrganizationController::class."@destroy");
                Route::post('/workflows',
                            OrganizationController::class."@store");
                Route::get('/workflows/{workflow}',
                           OrganizationController::class."@show");

            });

    });
