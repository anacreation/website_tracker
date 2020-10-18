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

use Anacreation\Organization\Http\Api\OrganizationController;
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
                                                null),
                     ],
            function() {

                Route::get('organizations',OrganizationController::class."@index")->name('organizations::index');

            });

    });
