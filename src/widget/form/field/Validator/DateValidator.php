<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Adianti\Base\App\Lib\Validator\TDateValidator;
use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator DateValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
  * @see https://t.me/davimenezes
 */
class DateValidator extends TDateValidator implements ValidatorContract
{
    use ValidatorImplementation;

    public function __construct($error_msg = null)
    {
        $this->error_msg = $error_msg;
    }

    public function validate($label, $value, array $parameters = null):bool
    {
        try {
            if (empty($value)) {
                return true;
            }
            parent::validate($label, $value, $parameters);
            return true;
        } catch (\Exception $e) {
            $this->error_msg = $this->error_msg ?? 'Campo de data inválido';
            return false;
        }
    }

    public function getErrorMsg()
    {
        return $this->error_msg;
    }
}
