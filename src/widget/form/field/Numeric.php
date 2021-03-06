<?php

namespace Dvi\Componente\Widget\Form\Fields;

use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\Type\FieldTypeFloat;
use Dvi\Component\Widget\Form\Field\Varchar;

/**
 * Fields Numeric
 *
 * @package    Fields
 * @subpackage Form
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Numeric extends Varchar implements FormField
{
    public function __construct(
        string $name,
        int $decimals,
        string $decimalsSeparator,
        string $thousandSeparator,
        bool $required = false,
        string $label = null,
        bool $replaceOnPost = true
    ) {
        parent::__construct($name);

        $this->tag->{'pattern'}   = '[0-9]*';
        $this->tag->{'inputmode'} = 'numeric';

        parent::setNumericMask($decimals, $decimalsSeparator, $thousandSeparator, $replaceOnPost);

        $this->setup($label ?? $name, $required);

        $this->setType(new FieldTypeFloat());
    }
}
