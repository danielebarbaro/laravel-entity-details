<?php

namespace Danielebarbaro\EntityDetail\Traits;

use Danielebarbaro\EntityDetail\EntityValidator;
use Danielebarbaro\EntityDetail\Models\Detail;
use Illuminate\Validation\ValidationException;

trait EntityDetailHydrate
{
    /**
     * @throws \Throwable
     * @throws ValidationException
     */
    public function syncDetail(array $details)
    {
        $data = EntityValidator::validate($details, $this->getValidationRules());

        try {
            $detail = Detail::updateOrCreate(
                [
                    'owner_id' => $this->id,
                    'owner_type' => $this::class,
                ],
                $data
            );

            return $this->detail()->save($detail);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function getValidationRules()
    {
        return $this->rules ?: [
            'is_company' => 'required|boolean',
            'status' => 'required|max:20',
            'code' => 'required|max:10',
            'name' => 'string|max:100',
            'secondary_email' => 'email',
            'sdi' => 'max:7',
            'pec' => 'email',
            'first_name' => 'string|max:60',
            'last_name' => 'string|max:60',
            'phone' => 'string|max:60',
            'mobile' => 'string|max:60',
            'fiscal_code' => 'string|max:16',
            'vat' => 'string|max:13',
            'postal_code' => 'string|max:6',
            'city' => 'string|max:30',
            'country' => 'string|max:2',
            'address' => 'string|max:100'
        ];
    }
}
