<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Validator\TEmailValidator;
use Dvi\Component\Widget\Form\Field\Contract\ValidatorContract;

/**
 * Validator EmailValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class EmailValidator implements ValidatorContract
{
    use ValidatorImplementation;

    public function validate(string $label, $value, array $parameters = null):bool
    {
        $translate = AdiantiCoreTranslator::translate('The field ^1 contains an invalid e-mail', $label);
        if (empty($value)) {
            $this->error_msg = $translate;
            return false;
        }
        $filter = filter_var(trim($value), FILTER_VALIDATE_EMAIL);

        if ($filter === false) {
            $this->error_msg = $translate;
            return false;
        }
        return true;
    }
}
