<?php

namespace Dvi\Component\Widget\Form\Field\Combo;

use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Widget\Base\TScript;
use Adianti\Base\Lib\Widget\Form\TCombo;
use Adianti\Base\Lib\Widget\Form\TForm;
use Dvi\Component\Widget\Form\Field\BaseComponentTrait;
use Dvi\Component\Widget\Form\Field\Contract\FormComponentEventContract;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\Display\ComponentDisplayImplementation;
use Dvi\Component\Widget\Form\Field\FieldComponent;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;
use Dvi\Component\Widget\Form\Field\FormFieldValidationTrait;
use Dvi\Component\Widget\Form\Field\Input\FormComponentEventImplementation;
use Dvi\Component\Widget\Form\Field\SearchableField;
use Dvi\Component\Widget\Form\Field\SelectionFieldTrait;
use Dvi\Support\View\View;
use Exception;

/**
 *  Combo
 * @package    form
 * @subpackage widget
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2017. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Combo extends TCombo implements FormField, FieldComponent, FormComponentEventContract
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;
    use SelectionFieldTrait;
    use BaseComponentTrait;
    use FormComponentEventImplementation;

    protected $field_disabled;

    public function __construct(string $name, string $label = null, $required = false, array $obj_array_value = null)
    {
        parent::__construct($name);

        $this->setup($label, $required);
        $this->useTip(false);
        $this->operator('=');

        if ($obj_array_value) {
            $this->items($this->getObjItems($obj_array_value));
        }

        $this->enableSearch();
    }

    public function enableSearch()
    {
        parent::enableSearch();
        $this->searchable = true;
        return $this;
    }

    public function disable($disable = true)
    {
        $this->field_disabled = true;

        $this->setEditable(!$disable);
    }

    public function isDisabled()
    {
        return $this->field_disabled;
    }

    protected function getTextPlaceholder()
    {
        if (!isset($this->placeholder)) {
            return null;
        }
        if ($this->isRequired()) {
            return '<span style="color: #d9534f">' . $this->placeholder . '</span>';
        }
    }

    public function prepareViewParams()
    {
        if (isset($this->changeAction)) {
            if (!TForm::getFormByName($this->formName) instanceof TForm) {
                throw new Exception(AdiantiCoreTranslator::translate('You must pass the ^1 (^2) as a parameter to ^3', __CLASS__, $this->name, 'TForm::setFields()'));
            }

            $string_action = $this->changeAction->serialize(false);
            $this->properties['changeaction'] = "__adianti_post_lookup('{$this->formName}', '{$string_action}', '{$this->properties['id']}', 'callback')";
            $this->properties['onChange'] = $this->getProperty('changeaction');
        }

        if (isset($this->changeFunction)) {
            $this->properties['changeaction'] = $this->changeFunction;
            $this->properties['onChange'] = $this->changeFunction;
        }

        // verify whether the widget is editable
        if (!parent::getEditable()) {
            // make the widget read-only
            $this->properties['onclick']  = "return false;";
            $this->properties['style'][]   = ';pointer-events:none';
            $this->properties['tabindex'] = '-1';
            $this->properties['class'][]    = 'tcombo_disabled';
        }

        if ($this->searchable) {
            $this->properties['role'] = 'tcombosearch';
        }

        $params = [
            'label' => $this->error_msg ? $this->wrapperStringClass('verifique') : $this->getLabel(),
            'field_info' => $this->getFieldInfoValidationErrorData($this->getLabel()),
            'option_items' => $this->getOptionItems(),
            'options_properties' => []
        ];

        return $params;
    }

    public function getView(array $data)
    {
        echo View::run("Widget/Form/Field/Combo/View/view.blade.php", $data);

        if ($this->searchable) {
            $select = $this->getTextPlaceholder();
            TScript::create("tcombo_enable_search('#{$this->id}', '{$select}')");

            if (!parent::getEditable()) {
                TScript::create(" tmultisearch_disable_field( '{$this->formName}', '{$this->name}'); ");
            }
        }
    }

    protected function getOptionItems()
    {
        $new_items = [];
        foreach ($this->items as $key => $item) {
            if (is_array($item)) {
                $new_items[$key] = $item;
                continue;
            }
            if ($this->value == $key) {
                $new_items[$key]['selected'] = false;
            }
            $new_items[$key]['value'] = $item;
        }
        return $new_items;
    }
}
