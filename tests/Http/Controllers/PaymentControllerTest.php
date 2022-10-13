<?php
/*
 * File name: PaymentControllerTest.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace Tests\Http\Controllers;

use Tests\Helpers\TestHelper;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{

    /**
     * @return void
     */
    public function testIndex()
    {
        $user = TestHelper::getAdmin();
        $response = $this->actingAs($user)
            ->get(route('payments.index'));
        $response->assertStatus(200);
        $response->assertSeeTextInOrder([__('lang.payment_desc'), __('lang.payment_table'), __('lang.payment_amount')]);
        $response->assertDontSeeText(__('lang.payment_create'));
    }
}
