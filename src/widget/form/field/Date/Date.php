<?php

namespace Dvi\Component\Widget\Form\Field\Date;

use Adianti\Base\Lib\Widget\Form\TDate;
use Dvi\Component\Widget\Form\Field\BaseComponentTrait;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FieldComponent;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;
use Dvi\Component\Widget\Form\Field\FormFieldValidationTrait;
use Dvi\Component\Widget\Form\Field\SearchableField;
use Dvi\Component\Widget\Form\Field\Validator\DateValidator;

/**
 *  Date
 * @package    form
 * @subpackage widget
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2017. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Date extends TDate implements FormField, FieldComponent
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;
    use BaseComponentTrait;

    protected $field_disabled;

    public function __construct($name, string $label = null, bool $required = false)
    {
        parent::__construct($name);

        $this->setup($label ?? $name, $required);
        $this->setMask('dd/mm/yyyy');
        $this->setDatabaseMask('yyyy-mm-dd');

        $this->operator('=');

        $this->addValidation($this->getLabel(), new DateValidator(), ['dd/mm/yyyy']);
    }

    public function disable($disable = true)
    {
        $this->field_disabled = $disable;

        parent::setEditable(!$disable);
    }

    public function isDisabled()
    {
        return $this->field_disabled;
    }

    public function getView(array $data)
    {
        view('Widget/Form/Field/Date/View/date.blade.php', $data);
    }

    public function prepareViewParams()
    {
        $js_mask = str_replace('yyyy', 'yy', $this->mask);
        $language = strtolower(LANG);
        $options = json_encode($this->options);

        if (parent::getEditable()) {
            $outer_size = 'undefined';
            if (strstr($this->size, '%') !== false) {
                $outer_size = $this->size;
                $this->size = '100%';
            }
        }

        $data = parent::getViewCustomParameters();
        $data['editable'] = parent::getEditable();
        $data['mask'] = $this->mask ?? 'dd/mm/yyyy';
        $data['language'] = $language;
        $data['outer_size'] = $outer_size;
        $data['options'] = $options;
        $data['error_msg'] = $this->error_msg;
        return $data;
    }


}
