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
class DateValidator implements ValidatorContract
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
            $mask = $parameters[0];
            $year_pos  = strpos($mask, 'yyyy');
            $month_pos = strpos($mask, 'mm');
            $day_pos   = strpos($mask, 'dd');

            $year      = substr($value, $year_pos, 4);
            $month     = substr($value, $month_pos, 2);
            $day       = substr($value, $day_pos, 2);

            if (!checkdate((int) $month, (int) $day, (int) $year)) {
                throw new Exception("The field $label is not a valid date ($mask)");
            }
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
