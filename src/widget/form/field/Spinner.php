<?php

namespace Dvi\Component\Widget\Form\Field;

use Adianti\Base\Lib\Widget\Form\TSpinner;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;

/**
 * Form Spinner
 *
 * @package    Form
 * @subpackage Widget
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Spinner extends TSpinner implements FormField
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;

    public function __construct(string $name, int $min, int $max, int $step, $label = null, bool $required = false)
    {
        parent::__construct($name);

        $this->setup($label ?? $name, $required, strlen($max));

        $this->operator('=');

        $this->setRange($min, $max, $step);
    }
}
