<?php

namespace Dvi\Component\Widget\Form\Field;

use Adianti\Base\Lib\Widget\Form\TMultiSearch;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;

/**
 * Field DBMultiSearch
 *
 * @package    Field
 * @subpackage Form
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 * @see https://t.me/davimenezes
 */
class MultiSearch extends TMultiSearch implements FormField
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;
    use SelectionFieldTrait;

    public function __construct($name, int $min_length, int $max_length = null, $label = null)
    {
        parent::__construct($name);

        $this->setup($label ?? $name, false, $max_length);

        $this->setMinLength($min_length);

        $this->setSize('100%', '46');
    }
}
