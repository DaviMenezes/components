<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator MaxValueValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class MaxValueValidator implements ValidatorContract
{
    protected $max_value;
    protected $default_msg;

    use ValidatorImplementation;

    public function __construct($max_value, string $error_msg = null)
    {
        $this->max_value = $max_value;
        $this->default_msg = $msg ?? 'Valor máximo('.$max_value.') inválido';
    }

    public function validate($label, $value, array $parameters = null):bool
    {
        if ($value > $this->max_value) {
            $this->error_msg = $this->default_msg;
            return false;
        }
        return true;
    }
}
