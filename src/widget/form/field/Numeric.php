<?php

namespace Dvi\Adianti\Componente\Model\Form\Fields;

use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Widget\Base\TScript;
use Adianti\Base\Lib\Widget\Form\TForm;
use Adianti\Base\Lib\Widget\Form\TNumeric;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;
use Dvi\Component\Widget\Form\Field\FormFieldValidationTrait;
use Dvi\Adianti\Widget\Form\Field\SearchableField;
use Dvi\Adianti\Widget\Form\Field\Type\FieldTypeFloat;
use Exception;

/**
 * Fields Numeric
 *
 * @package    Fields
 * @subpackage Form
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Numeric extends TNumeric implements FormField
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;

    public function __construct($name, $decimals, $decimalsSeparator, $thousandSeparator, $required = false, string $label = null, bool $replaceOnPost = true)
    {
        parent::__construct($name, $decimals, $decimalsSeparator, $thousandSeparator, $replaceOnPost);

        $this->setup($label ?? $name, $required);

        $this->setType(new FieldTypeFloat());
    }
}
