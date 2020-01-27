<?php

namespace Dvi\Component\Widget\Form\Field\Input;

use Adianti\Base\Lib\Control\TAction;
use Adianti\Base\Lib\Core\AdiantiCoreTranslator;
use Adianti\Base\Lib\Widget\Form\TForm;
use Dvi\Component\Widget\Form\Field\Contract\FormComponentEventContract;
use Exception;

/**
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 */
trait FormComponentEventImplementation
{
    public function createFieldActions():void
    {
        if (!parent::getEditable()) {
            return;
        }
        if (isset($this->exitAction)) {
            $this->createFieldAction($this->exitAction, 'exitaction', 'onBlur', $this->exitFunction);
        } elseif (isset($this->changeAction)) {//Todo o componente Unique (radio) nao posssui a propriedade changeAction
            $this->createFieldAction($this->changeAction, 'changeaction', 'onChange', $this->changeFunction);
        }
    }

    public function createFieldAction($action, $custom_event, $event, $function = null): void
    {
        if (!TForm::getFormByName($this->formName) instanceof TForm) {
            throw new Exception(AdiantiCoreTranslator::translate('You must pass the ^1 (^2) as a parameter to ^3', __CLASS__, $this->name, 'TForm::setFields()'));
        }

        $string_action = $action->serialize(false);

        $this->setPropertyPostLookup($custom_event, $string_action);

        // just aggregate event, if the previous one does not have return clause
        if (strstr($this->getProperty($event), 'return') == false) {
            /**@var TAction $eventAction*/
            $eventAction = clone $action;
            $eventAction->setParameter('js_method', $event);
            $string_action = $eventAction->serialize(false);
            $this->setPropertyPostLookup($event, $string_action, true);
        } else {
            $this->setPropertyPostLookup($event, $string_action, false);
        }

        if (isset($function)) {
            if (strstr($this->getProperty($event), 'return') == false) {
                $this->setProperty($event, $function, false);
            } else {
                $this->setProperty($event, $function, true);
            }
        }
        if (method_exists($this, 'getMask') and $this->getMask()) {
            $this->tag->{'onKeyPress'} = "return tentry_mask(this,event,'{$this->getMask()}')";
        }
    }

    protected function setPropertyPostLookup(string $js_method, string $string_action, $replace = false): void
    {
        $this->setProperty($js_method, "__adianti_post_lookup('{$this->formName}', '{$string_action}', '{$this->id}', 'callback')", $replace);
    }
}
