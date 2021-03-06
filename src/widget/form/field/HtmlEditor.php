<?php

namespace Dvi\Component\Widget\Form\Field;

use Adianti\Base\Lib\Widget\Form\THtmlEditor;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;

/**
 * Form HtmlEditor
 *
 * @package    Form
 * @subpackage Widget
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class HtmlEditor extends THtmlEditor implements FormField
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;

    public function __construct(string $name, int $height, $label, bool $required = false)
    {
        parent::__construct($name);

        $this->setup($label, $required);

        $this->setSize('100%', $height);
    }

    public function show()
    {
        parent::show();
//        Script::add('remove_note-popover', ' $(".note-popover").remove();');
    }
}
