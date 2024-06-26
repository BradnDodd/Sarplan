<?php

namespace App\Http\Requests\Team;

use App\Enums\Team\TeamTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class TeamUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|unique:users,name',
            'type' => ['required', new EnumRule(TeamTypeEnum::class)],
            'active' => 'bool',
        ];
    }

    /**
     * @return array<string, class-string>
     */
    public function enums(): array
    {
        return [
            'type' => TeamTypeEnum::class,
        ];
    }
}
