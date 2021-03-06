<?php

namespace Dvi\Component\Widget\Form\Field\Type;

use Dvi\Component\Widget\Form\Field\Contract\FieldTypeInterface;

/**
 * Field FieldTypeFloat
 *
 * @package    Field
 * @subpackage Form
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class FieldTypeFloat implements FieldTypeInterface
{
    public function sanitize($value)
    {
        $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return $value;
    }
}
