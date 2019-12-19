<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator MinValueValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class MinValueValidator implements ValidatorContract
{
    protected $min_value;
    protected $default_error_msg;

    use ValidatorImplementation;

    public function __construct($min_value = 0, string $error_msg = null)
    {
        $this->min_value = $min_value;
        $this->default_error_msg = $error_msg ?? 'Valor mínimo ('.$min_value.') inválido';
    }

    public function validate($label, $value, array $parameters = null):bool
    {
        if ($value < $this->min_value) {
            $this->error_msg = $this->default_error_msg;
            return false;
        }
        return true;
    }
}
