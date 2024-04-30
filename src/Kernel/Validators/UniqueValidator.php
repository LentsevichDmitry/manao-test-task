<?php


namespace AuthManao\Kernel\Validators;

use AuthManao\Kernel\HttpException\HTTPBadRequestException;
use Exception;

class UniqueValidator implements Validator
{
    private $array;
    private $comparator;

    public function configure($array, $comparator): self
    {
        $this->array = $array;
        $this->comparator = $comparator;

        return $this;
    }

    public function validate($value)
    {
        foreach ($this->array as $item) {
            if (call_user_func($this->comparator, $item, $value)) {
                throw new HTTPBadRequestException('should be unique');
            }
        }
    }
}