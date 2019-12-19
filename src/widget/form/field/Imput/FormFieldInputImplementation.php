<?php

namespace Dvi\Component\Widget\Form\Field\Input;

use Adianti\Base\Lib\Control\TAction;
use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Widget\Form\TForm;
use Dvi\Component\Widget\Form\Field\Contract\FormComponentImputContract;

/**
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 */
trait FormFieldInputImplementation
{
    public function createExitAction(): void
    {
        if (!parent::getEditable()) {
            return;
        }

        if (isset($this->exitAction)) {
            if (!TForm::getFormByName($this->formName) instanceof TForm) {
                throw new Exception(AdiantiCoreTranslator::translate('You must pass the ^1 (^2) as a parameter to ^3', __CLASS__, $this->name, 'TForm::setFields()'));
            }
            $string_action = $this->exitAction->serialize(false);

            $this->setPropertyPostLookup('exitaction', $string_action);

            // just aggregate onBlur, if the previous one does not have return clause
            if (strstr($this->getProperty('onBlur'), 'return') == false) {
                /**@var TAction $onBlurAction*/
                $onBlurAction = clone $this->exitAction;
                $onBlurAction->setParameter('js_method', 'onBlur');
                $string_action = $onBlurAction->serialize(false);
                $this->setPropertyPostLookup('onBlur', $string_action, true);
            } else {
                $this->setPropertyPostLookup('onBlur', $string_action, false);
            }
        }

        if (isset($this->exitFunction)) {
            if (strstr($this->getProperty('onBlur'), 'return') == false) {
                $this->setProperty('onBlur', $this->exitFunction, false);
            } else {
                $this->setProperty('onBlur', $this->exitFunction, true);
            }
        }
        if ($this->getMask()) {
            $this->tag->{'onKeyPress'} = "return tentry_mask(this,event,'{$this->getMask()}')";
        }
    }

    protected function setPropertyPostLookup(string $js_method, string $string_action, $replace = false): void
    {
        $this->setProperty($js_method, "__adianti_post_lookup('{$this->formName}', '{$string_action}', '{$this->id}', 'callback')", $replace);
    }
}
