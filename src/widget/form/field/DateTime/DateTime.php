<?php

namespace Dvi\Component\Widget\Form\Field\DateTime;

use Adianti\Base\App\Lib\Validator\TDateValidator;
use Adianti\Base\Lib\Widget\Form\TDateTime;
use Dvi\Component\Widget\Form\Field\BaseComponentTrait;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FieldComponent;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;
use Dvi\Component\Widget\Form\Field\FormFieldValidationTrait;
use Dvi\Component\Widget\Form\Field\SearchableField;

/**
 * Fields DateTime
 *
 * @package    Fields
 * @subpackage Form
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class DateTime extends TDateTime implements FormField, FieldComponent
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;
    use BaseComponentTrait;

    /**
     * @var string
     */
    protected $varchar_mask;

    public function __construct($name, $label = null, $required = false)
    {
        parent::__construct($name);

        $this->setup($label ?? $name, $required);
        $this->setMask('dd/mm/yyyy hh:ii');
        $this->setDatabaseMask('yyyy-mm-dd hh:ii');
        $this->addValidation($this->getLabel(), new TDateValidator());
        $this->operator('=');
    }

    public function setMask($mask, $replaceOnPost = false)
    {
        $this->mask = $mask;

        $this->replaceOnPost = $replaceOnPost;

        $newmask = $this->mask;
        $newmask = str_replace('dd', '99', $newmask);
        $newmask = str_replace('hh', '99', $newmask);
        $newmask = str_replace('ii', '99', $newmask);
        $newmask = str_replace('mm', '99', $newmask);
        $newmask = str_replace('yyyy', '9999', $newmask);

        $this->varchar_mask = $newmask;
    }

    public function getView(array $data)
    {
        view('Widget/Form/Field/DateTime/View/date_time.blade.php', $data);
    }

    public function prepareViewParams()
    {
        $language = strtolower(LANG);
        $options = json_encode($this->options);

        if (parent::getEditable()) {
            $outer_size = 'undefined';
            if (strstr($this->size, '%') !== false) {
                $outer_size = $this->size;
                $this->size = '100%';
            }
        }

        $data = $this->getViewCustomParameters();
        $data['editable'] = parent::getEditable();
        $data['varchar_mask'] = $this->varchar_mask;
        $data['mask'] = $this->mask;
        $data['language'] = $language;
        $data['outer_size'] = $outer_size;
        $data['options'] = $options;
        $data['error_msg'] = $this->error_msg;
        return $data;
    }
}
