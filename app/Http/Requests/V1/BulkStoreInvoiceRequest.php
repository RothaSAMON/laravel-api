<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
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
        // return [
        //     '*.customerId' => ['required', 'integer'],
        //     '*.amount' => ['required', 'numeric'],
        //     '*.status' => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
        //     '*.billedDate' => ['required', 'date_format:Y-m-d H:i:s'],
        //     '*paidDate'=> ['date_format:Y-m-d H:i:s', 'nullable'],
        // ];
        return [
            '*.customer_id' => ['required', 'integer'],
            '*.amount' => ['required', 'numeric'],
            '*.status' => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
            '*.billed_date' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paid_date' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }

    // protected function prepareForValidation() {
    //     $data = [];

    //     foreach ($this->toArray() as $obj) {
    //         $obj['customer_id'] = $obj['customerId'] ?? null;
    //         $obj['billed_date'] = $obj['billedDate'] ?? null;
    //         $obj['paid_date'] = $obj['paidDate'] ?? null;

    //         $data[] = $obj;
    //     }

    //     $this->merge($data);
    // }
    protected function prepareForValidation() {
        $data = [];
    
        foreach ($this->toArray() as $obj) {
            $data[] = [
                'customer_id' => $obj['customerId'] ?? null,
                'amount' => $obj['amount'] ?? null,
                'status' => $obj['status'] ?? null,
                'billed_date' => $obj['billedDate'] ?? null,
                'paid_date' => $obj['paidDate'] ?? null,
            ];
        }
    
        $this->merge($data);
    }
}
