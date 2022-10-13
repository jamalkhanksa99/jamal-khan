<?php
/*
 * File name: EProviderTest.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace Models;

use App\Models\EProvider;
use Carbon\Carbon;
use Tests\TestCase;

class EProviderTest extends TestCase
{

    public function testGetAvailableAttribute()
    {
        $eProvider = EProvider::find(17);
        $this->assertTrue($eProvider->available);
        $this->assertTrue($eProvider->accepted);
        $this->assertTrue($eProvider->openingHours()->isOpenAt(new Carbon('2021-02-05 12:00:00')));
    }

    public function testOpeningHours()
    {
        $eProvider = EProvider::find(17);
        $open = $eProvider->openingHours()->isOpenAt(new Carbon('2021-02-05 12:00:00'));
        $this->assertTrue($open);
    }

    public function testWeekCalendar()
    {
        $eProvider = EProvider::find(17);
        $dates = $eProvider->weekCalendar(Carbon::now());
        $this->assertIsArray($dates);
    }

    public function testGetHasValidSubscriptionAttribute()
    {
        $eProvider = EProvider::find(15);
        $this->assertTrue($eProvider->has_valid_subscription);
    }
}
