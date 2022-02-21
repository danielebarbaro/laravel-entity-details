<?php

namespace Danielebarbaro\EntityDetail;

use Danielebarbaro\EntityDetail\Exceptions\ValidateDetailException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EntityValidator
{
    /**
     * @throws \Throwable
     * @throws ValidationException
     */
    public static function validate(array $details, array $rules): array
    {
        $validator = Validator::make($details, $rules);

        throw_if(
            $validator->fails(),
            ValidateDetailException::class,
            $validator->getMessageBag()
        );

        return $validator->validated();
    }
}
