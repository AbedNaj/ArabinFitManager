<?php

namespace App\Http\Requests\Admin\Debt;

use App\Enums\DebtStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDebtRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'remaining_amount' => 'numeric|required',
            'paid_amount' => 'numeric|required|min:1'
        ];
    }


    public function getDebtStatus($paid_amount, $remaining_amount)
    {
        return match (true) {
            $paid_amount == $remaining_amount => DebtStatusEnum::PAID->value,

            default => DebtStatusEnum::PARTIAL->value
        };
    }
}
