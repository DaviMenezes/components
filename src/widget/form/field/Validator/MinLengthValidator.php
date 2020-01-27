<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator MinLengthValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class MinLengthValidator implements ValidatorContract
{
    use ValidatorImplementation;

    public function __construct($min_value = 0, string $error_msg = null)
    {
        $this->value1 = $min_value;
        $this->error_msg = $error_msg ?? 'Tamanho mínimo ('.$min_value.') inválido';
    }

    public function validate($label, $value, array $parameters = null):bool
    {
        if (strlen($value) < $this->value1) {
            return false;
        }
        return true;
    }
    public function getErrorMsg()
    {
        return 'O comprimento mínimo é '.$this->value1;
    }
}
