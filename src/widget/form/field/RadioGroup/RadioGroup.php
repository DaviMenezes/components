<?php

namespace Dvi\Component\Widget\Form\Field\RadioGroup;

use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Widget\Base\TElement;
use Adianti\Base\Lib\Widget\Form\TForm;
use Adianti\Base\Lib\Widget\Form\TRadioGroup;
use Dvi\Component\Widget\Form\Field\BaseComponentTrait;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FieldComponent;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;
use Dvi\Component\Widget\Form\Field\FormFieldValidationTrait;
use Dvi\Component\Widget\Form\Field\SearchableField;

/**
 * RadioGroup
 * @package    Form
 * @subpackage Widget
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class RadioGroup extends TRadioGroup implements FormField, FieldComponent
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;
    use BaseComponentTrait;

    protected $field_disabled;

    public function __construct(string $name, $label = null, $required = false)
    {
        parent::__construct($name);

        $this->setup($label ?? $name, $required);

        $this->setLayout('horizontal');
        $this->setUseButton();

        $this->operator('=');
    }

    public function items(array $items)
    {
        $this->addItems($items);
    }

    public function disable($disable = true)
    {
        $this->field_disabled = $disable;

        $this->setEditable(!$disable);
    }

    public function isDisabled()
    {
        return $this->field_disabled;
    }

    public function prepareViewParams()
    {
        $data = $this->getViewCustomParameters();
        $data['useButton'] = $this->useButton;

        if ($this->useButton) {
            echo '<div data-toggle="buttons">';
            $data['size_use_percentage'] = false;
            if (strpos($this->getSize(), '%') !== false) {
                $data['size_use_percentage'] = true;
//                echo '<div class="btn-group" style="clear:both;float:left;width:100%">';
            } else {
//                echo '<div class="btn-group" style="clear:both;float:left">';
            }
        }


        if ($this->getItems()) {
            $data['items'] = $this->getItems();
            // iterate the RadioButton options
            $i = 0;
            $new_items = [];
            foreach ($this->getItems() as $index => $item) {

                $new_item = '';
                $new_items[] =
//                $button = $this->buttons[$index];
//                $button->setName($this->name);
//                $active = false;

                // check if contains any value
//                if ($this->value == $index and !(is_null($this->value)) and strlen((string) $this->value) > 0) {
//                    // mark as checked
//                    $button->setProperty('checked', '1');
//                    $active = true;
//                }

                // create the label for the button
                $obj = $this->labels[$index];
                $obj->{'class'} = $this->labelClass. ($active?'active':'');

                if ($this->getSize() and !$obj->getSize()) {
                    $obj->setSize($this->getSize());
                }

                if ($this->getSize() and $this->useButton) {
                    if (strpos($this->getSize(), '%') !== false) {
                        $size = str_replace('%', '', $this->getSize());
                        $obj->setSize(($size / count($this->items)) . '%');
                    } else {
                        $obj->setSize($this->getSize());
                    }
                }

                // check whether the widget is non-editable
                $data['editable'] = false;
                $data['change_action'] = false;
                if (parent::getEditable()) {
                    $data['editable'] = true;
                    if (isset($this->changeAction)) {

                        if (!TForm::getFormByName($this->formName) instanceof TForm) {
                            throw new Exception(AdiantiCoreTranslator::translate('You must pass the ^1 (^2) as a parameter to ^3', __CLASS__, $this->name, 'TForm::setFields()'));
                        }

                        $data['event_change_action'] = [
                            'form_name' => $this->formName,
                            'string_action' => $this->changeAction->serialize(false),
                            'id' => $this->id
                        ];
//                        $button->setProperty('changeaction', "__adianti_post_lookup('{$this->formName}', '{$string_action}', this, 'callback')");
//                        $button->setProperty('onChange', $button->getProperty('changeaction'), false);
                    }

                    //Todo implementar view para changeFunction
                    if (isset($this->changeFunction)) {
//                        $button->setProperty('changeaction', $this->changeFunction, false);
//                        $button->setProperty('onChange', $this->changeFunction, false);
                    }
                } else {
//                    $button->setEditable(false);
//                    $obj->setFontColor('gray');
                }

//                $obj->add($button);
//                $obj->show();
//                $i ++;
//
//                if ($this->layout == 'vertical' or ($this->breakItems == $i)) {
//                    $i = 0;
//                    if ($this->useButton) {
//                        echo '</div>';
//                        echo '<div class="btn-group" style="clear:both;float:left">';
//                    } else {
//                        // shows a line break
//                        $br = new TElement('br');
//                        $br->show();
//                    }
//                }
//                echo "\n";
            }
        }

//        if ($this->useButton) {
//            echo '</div>';
//            echo '</div>';
//        }
        return $data;
    }

    public function getView(array $data)
    {
        view('Widget/Form/Field/RadioGroup/View/radio_group.blade.php', $data);
    }
}
