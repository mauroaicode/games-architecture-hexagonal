<?php

namespace Core\BoundedContext\Game\Infrastructure\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                "max:255",
                Rule::unique("games", "name")->ignore(request("game")),
            ],
            "description" => "required|string",
            "pathImage" => "required|string",
            "url" => "required|string",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'response' => 'error_form',
            'data' => $validator->errors()

        ], 400));
    }
}
