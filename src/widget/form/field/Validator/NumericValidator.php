<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Adianti\Base\Lib\Validator\TNumericValidator;
use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator NumericValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class NumericValidator extends TNumericValidator implements ValidatorContract
{
    use ValidatorImplementation;

    public function validate($label, $value, array $parameters = null):bool
    {
        try {
            parent::validate($label, $value, $parameters);
            return true;
        } catch (\Exception $exception) {
            $this->error_msg = $exception->getMessage();
            return false;
        }
    }
}
