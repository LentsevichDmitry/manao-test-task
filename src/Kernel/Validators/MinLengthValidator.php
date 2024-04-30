<?php


namespace AuthManao\Kernel\Validators;


use AuthManao\Kernel\HttpException\HTTPBadRequestException;

class MinLengthValidator implements Validator
{
    private $minLength = 0;

    /**
     * @param int $minLength
     */
    public function setMinLength(int $minLength): self
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function validate($value)
    {
        if (strlen($value) < $this->minLength)
        {
            throw new HTTPBadRequestException('length should be greater then ' . $this->minLength);
        }
    }
}