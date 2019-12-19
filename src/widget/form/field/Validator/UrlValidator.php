<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Validator\TFieldValidator;
use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator UrlValidator
 * @package    Validator
 * @subpackage Adianti
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2017. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class UrlValidator extends TFieldValidator implements ValidatorContract
{
    use ValidatorImplementation;

    public function validate($label, $value, array $parameters = null):bool
    {
        $filter = filter_var(trim($value), FILTER_VALIDATE_URL);

        if ($filter === false) {
            $this->error_msg = AdiantiCoreTranslator::translate('The field ^1 contains an invalid url', $label);
            return false;
        }
        return true;
    }
}
