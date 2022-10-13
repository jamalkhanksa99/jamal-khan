<?php
/*
 * File name: UpdateWalletTransactionRequest.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Requests;

use App\Models\WalletTransaction;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWalletTransactionRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return WalletTransaction::$rules;
    }
}
