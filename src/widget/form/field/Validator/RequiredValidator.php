<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator RequiredValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class RequiredValidator implements ValidatorContract
{
    use ValidatorImplementation;

    public function __construct(string $error_msg = null)
    {
        $this->error_msg_default = 'Campo obrigatório';
    }

    public function validate($label, $value, array $parameters = null):bool
    {
        if ((is_null($value))
            or (is_scalar($value) and !is_bool($value) and trim($value)=='')
            or (is_array($value) and count($value)==1 and isset($value[0]) and empty($value[0]))
            or (is_array($value) and empty($value))) {
            $this->error_msg = $this->error_msg ?? $this->error_msg_default;
            return false;
        }
        return true;
    }
}
