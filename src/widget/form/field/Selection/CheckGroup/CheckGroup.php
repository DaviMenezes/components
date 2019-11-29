<?php

namespace Dvi\Component\Widget\Form\Field\Selection\CheckGroup;

use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Widget\Base\TElement;
use Adianti\Base\Lib\Widget\Form\TCheckGroup;
use Adianti\Base\Lib\Widget\Form\TForm;
use Dvi\Component\Widget\Form\Field\BaseComponentTrait;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\FieldComponent;
use Dvi\Component\Widget\Form\Field\FormFieldTrait as FormFieldTrait;
use Dvi\Component\Widget\Form\Field\FormFieldValidationTrait;
use Dvi\Component\Widget\Form\Field\SearchableField;

/**
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 */
class CheckGroup extends TCheckGroup implements FormField, FieldComponent
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;
    use BaseComponentTrait;

    public function __construct(string $name, string $label, $required = false)
    {
        parent::__construct($name);

        $this->setup($label ?? '', $required);

        $this->operator('like');

        $this->setUseButton();
    }

    public function prepareViewParams()
    {
        if ($this->useButton) {
            echo '<div data-toggle="buttons">';
            echo '<div class="btn-group" style="clear:both;float:left">';
        }

        if ($this->items) {
            // iterate the checkgroup options
            $i = 0;
            foreach ($this->items as $index => $label) {
                $button = $this->buttons[$index];
                $button->setName($this->name.'[]');
                $active = false;

                // verify if the checkbutton is checked
                if ((@in_array($index, $this->value) and !(is_null($this->value))) or $this->allItemsChecked) {
                    $button->setValue($index); // value=indexvalue (checked)
                    $active = true;
                }

                // create the label for the button
                $obj = $this->labels[$index];
                $obj->{'class'} = $this->labelClass . ($active?'active':'');
                $obj->setTip($this->tag->title);

                if ($this->getSize() and !$obj->getSize()) {
                    $obj->setSize($this->getSize());
                }

                // check whether the widget is non-editable
                if (parent::getEditable()) {
                    if (isset($this->changeAction)) {
                        if (!TForm::getFormByName($this->formName) instanceof TForm) {
                            throw new Exception(AdiantiCoreTranslator::translate('You must pass the ^1 (^2) as a parameter to ^3', __CLASS__, $this->name, 'TForm::setFields()'));
                        }
                        $string_action = $this->changeAction->serialize(false);

                        $button->setProperty('changeaction', "__adianti_post_lookup('{$this->formName}', '{$string_action}', this, 'callback')");
                        $button->setProperty('onChange', $button->getProperty('changeaction'), false);
                    }

                    if (isset($this->changeFunction)) {
                        $button->setProperty('changeaction', $this->changeFunction, false);
                        $button->setProperty('onChange', $this->changeFunction, false);
                    }
                } else {
                    $button->setEditable(false);
                    $obj->setFontColor('gray');
                }

                $obj->add($button);
                $obj->show();
                $i ++;

                if ($this->layout == 'vertical' or ($this->breakItems == $i)) {
                    $i = 0;
                    if ($this->useButton) {
                        echo '</div>';
                        echo '<div class="btn-group" style="clear:both;float:left">';
                    } else {
                        // shows a line break
                        $br = new TElement('br');
                        $br->show();
                    }
                }
                echo "\n";
            }
        }

        if ($this->useButton) {
            echo '</div>';
            echo '</div>';
        }
    }

    public function getView(array $data)
    {
        view('Widget.Form.Field.Selection.CheckGroup.View.checkgroup.blade.php');
    }
}
