<?php


namespace Imdhemy\Purchases\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Imdhemy\Purchases\Http\Rules\ValidReceipt;

/**
 * Class AppStoreServerNotificationRequest
 * @package Imdhemy\Purchases\Http\Requests
 */
class AppStoreServerNotificationRequestV2 extends FormRequest
{
    /**
     * Validates the request body
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'signedPayload' => ['required', 'string'],
        ];
    }

    /**
     * Authorizes the request
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
