<?php
/*
 * File name: WalletTransactionsTableSeeder.php

 * Author: DAS360
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class WalletTransactionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('wallet_transactions')->count() == 0) {
            DB::table('wallet_transactions')->delete();
            DB::table('wallet_transactions')->insert(array(
                array(
                    'id' => '01194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '01194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
                array(
                    'id' => '02194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '02194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
                array(
                    'id' => '03194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '03194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
                array(
                    'id' => '04194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '04194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
                array(
                    'id' => '05194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '05194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
                array(
                    'id' => '06194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '06194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
                array(
                    'id' => '07194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '07194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
                array(
                    'id' => '8d194a4f-f302-47af-80b2-ceb2075d36dc',
                    'description' => 'First Transaction',
                    'amount' => 200,
                    'user_id' => 1,
                    'action' => 'credit',
                    'wallet_id' => '8d194a4f-f302-47af-80b2-ceb2075d36dc',
                    'created_at' => '2021-08-07 13:17:34',
                    'updated_at' => '2021-08-07 13:17:34',
                ),
            ));
        }
    }
}
