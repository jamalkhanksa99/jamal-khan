<?php
/*
 * File name: EServiceTest.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace Models;

use App\Models\EService;
use Tests\TestCase;

class EServiceTest extends TestCase
{

    public function testGetAvailableAttribute()
    {
        $eService = EService::find(32);
        self::assertTrue($eService->available);
    }
}
