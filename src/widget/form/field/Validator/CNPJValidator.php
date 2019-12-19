<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator CNPJValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class CNPJValidator implements ValidatorContract
{
    use ValidatorImplementation;

    /**
     * Validate a given value
     * @param string $label Identifies the value to be validated in case of exception
     * @param string $value Value to be validated
     * @param array $parameters aditional parameters for validation
     * @return bool
     */
    public function validate(string $label, $value, array $parameters = null):bool
    {
        $cnpj = preg_replace("@[./-]@", "", $value);
        $translate = AdiantiCoreTranslator::translate('The field ^1 has not a valid CNPJ', $label);
        if (strlen($cnpj) <> 14 or !is_numeric($cnpj)) {
            $this->error_msg = $translate;
        }
        $k = 6;
        $soma1 = 0;
        $soma2 = 0;
        for ($i = 0; $i < 13; $i++) {
            $k = $k == 1 ? 9 : $k;
            $soma2 += ($cnpj{$i} * $k);
            $k--;
            if ($i < 12) {
                if ($k == 1) {
                    $k = 9;
                    $soma1 += ($cnpj{$i} * $k);
                    $k = 1;
                } else {
                    $soma1 += ($cnpj{$i} * $k);
                }
            }
        }

        $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
        $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

        $valid = ($cnpj{12} == $digito1 and $cnpj{13} == $digito2);

        if (!$valid) {
            $this->error_msg = $this->error_msg ? "<br>". $translate : $translate;
        }
        if ($this->error_msg) {
            return false;
        }
        return true;
    }
}
