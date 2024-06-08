<?php

namespace App\Http\Requests\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\Enum\Laravel\Rules\EnumRule;

class CalloutStoreRequest extends FormRequest
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
            'start_time' => 'required|date',
            'end_time' => 'date|nullable',
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

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
