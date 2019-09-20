<?php

namespace Dvi\Adianti\Widget\Form\Field;

use Adianti\Base\Lib\Widget\Form\THidden;
use Dvi\Adianti\Widget\Form\Field\Type\FieldTypeString;
use Dvi\Support\View\View;

/**
 * Form Hidden
 * @package    Form
 * @subpackage Widget
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2017. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Hidden extends THidden
{
    use FormFieldTrait;
    use FormFieldValidationTrait;

    public function __construct(string $name, $default_value = null)
    {
        parent::__construct($name);

        if ($default_value) {
            $this->setValue($default_value);
        }

        $this->setType(new FieldTypeString());
    }

    public function showView()
    {
        // set the tag properties
        $this->tag->{'id'}     = 'thidden_' . mt_rand(1000000000, 1999999999);
        $this->tag->{'name'}   = $this->name;  // tag name
        $this->tag->{'value'}  = $this->value; // tag value
        $this->tag->{'type'}   = 'hidden';     // input type
        $this->tag->{'widget'} = 'thidden';
        $this->tag->{'style'}  = "width:{$this->size}";

        $properties = $this->tag->getProperties();

        $data = [];
        foreach ($properties as $property => $value) {
            if (empty($value)) {
                continue;
            }
            $data[$property] = $value;
        }

        $params = [
            'label' => $this->error_msg ? $this->wrapperStringClass('verifique') : $this->getLabel(),
            'field_info' => $this->getFieldInfoValidationErrorData($this->getLabel()),
            'properties' => $data
        ];
        $this->view($params);
    }

    protected function view($data)
    {
        echo View::run("widget/form/field/Hidden/View/hidden.blade.php", $data);
    }
}
