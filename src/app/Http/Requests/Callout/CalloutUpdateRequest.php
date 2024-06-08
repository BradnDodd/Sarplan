<?php

namespace App\Http\Requests\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class CalloutUpdateRequest extends FormRequest
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
            'primary_team' => 'required|int',
            'start_date' => 'required|datetime',
            'end_date' => 'datetime',
            'status' => ['required', new EnumRule(CalloutStatusEnum::class)],
            'active' => 'bool',
        ];
    }

    /**
     * @return array<string, class-string>
     */
    public function enums(): array
    {
        return [
            'status' => CalloutStatusEnum::class,
        ];
    }
}
