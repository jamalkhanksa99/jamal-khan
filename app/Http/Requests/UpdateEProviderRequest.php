<?php
/*
 * File name: UpdateEProviderRequest.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Requests;

use App\Models\EProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEProviderRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return EProvider::$rules;
    }

    /**
     * @return array
     */
    public function validationData(): array
    {
        if (!auth()->user()->hasRole('admin')) {
            $this->offsetUnset('accepted');
        }
        return parent::validationData();
    }


}
