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
    protected $min_length;
    protected $default_error_msg;

    use ValidatorImplementation;

    public function __construct($min_value = 0, string $error_msg = null)
    {
        $this->min_length = $min_value;
        $this->error_msg = $error_msg ?? 'Tamanho mínimo ('.$min_value.') inválido';
    }

    public function setParameters($params)
    {
        $this->min_length = $params['value1'] ?? $this->min_length;
        $this->error_msg = $params['error_msg'] ?? $this->error_msg;
    }

    public function validate($label, $value, array $parameters = null):bool
    {
        if (strlen($value) < $this->min_length) {
            return false;
        }
        return true;
    }
    public function getErrorMsg()
    {
        return 'O comprimento mínimo é '.$this->min_length;
    }
}
