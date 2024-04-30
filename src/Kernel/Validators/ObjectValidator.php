<?php

namespace AuthManao\Kernel\Validators;

use AuthManao\Kernel\HttpException\HTTPBadRequestException;
use AuthManao\Kernel\HttpException\HTTPException;

class ObjectValidator implements Validator
{
    private $fields = [];

    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function validate($value)
    {
        $errors = [];
        foreach ($this->fields as $field => $validators) {
            try {
                foreach ($validators as $validator) {
                    $validator->validate($value->$field);
                }
            } catch (HTTPException $exception) {
                $errors[$field] = $exception->getMessage();
            }
        }

        if ($errors) {
            throw new HTTPBadRequestException(json_encode($errors));
        }
    }
}