<?php

namespace App\Http\Requests\User\UserGroup;

use App\Enums\User\UserGroup\UserGroupPrivacyEnum;
use App\Enums\User\UserGroup\UserGroupTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class UserGroupStoreRequest extends FormRequest
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
            'name' => 'required|string:max:255',
            'privacy' => ['required', new EnumRule(UserGroupPrivacyEnum::class)],
            'creator' => 'required|int',
            'description' => 'string',
        ];
    }

    /**
     * @return array<string, class-string>
     */
    public function enums(): array
    {
        return [
            'privacy' => UserGroupPrivacyEnum::class,
        ];
    }
}
