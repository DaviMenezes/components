<?php

namespace Dvi\Component\Widget\Form\Field\Type;

use Dvi\Component\Widget\Form\Field\Contract\FieldTypeInterface;

/**
 * Type FieldTypeHtml
 *
 * @package    Type
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class FieldTypeHtml implements FieldTypeInterface
{
    public function sanitize($value)
    {
        $value = filter_var($value);
        return $value;
    }
}
