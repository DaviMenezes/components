<?php

namespace Dvi\Component\Widget\Form\Field;

use Dvi\Component\Widget\Container\VBox;
use Dvi\Component\Widget\Form\Field\Contract\FieldTypeInterface;
use Dvi\Component\Widget\Form\Field\Date\Date;
use Dvi\Component\Widget\Form\Field\DateTime\DateTime;
use Dvi\Component\Widget\Form\Field\Hidden\Hidden;
use Dvi\Component\Widget\Form\Field\RadioGroup\RadioGroup;
use Dvi\Component\Widget\Form\Field\Validator\MaxLengthValidator;
use Dvi\Component\Widget\Form\Field\Validator\RequiredValidator;
use Dvi\Support\Environment\Environment;
use Dvi\Support\Http\Request;

/**
 * Field DField
 *
 * @package    Field
 * @subpackage Form
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
trait FormFieldTrait
{
    /**@var Request*/
    protected $request;
    protected $field_disabled;
    /**@var FieldTypeInterface */
    protected $type;
    protected $error_msg = array();
    protected $required;
    protected $label_class;
    protected $base_class_name;
    protected $reference_name;
    protected $tip;
    protected $max_length;
    protected $field_label;
    protected $use_label_field;
    protected $placeholder;

    public function setup(string $label = null, bool $required = false, int $max_length = null)
    {
        $this->setProperty('id', $this->id);
        $this->setProperty('name', $this->getName());
        $this->setProperty('placeholder', strtolower($label ?? $this->getName()));
        $this->setProperty('value', $this->getValue());
        $this->setSize('100%');

        $this->label(ucfirst($label));
        $this->required = $required;
        if ($required) {
            $this->setProperty('required', 'required');
        }
        $this->max_length = $max_length > 0 ? $max_length : null;
        $this->tip = true;
    }

    public function useLabelField(bool $use = true)
    {
        $this->use_label_field = $use;
        return $this;
    }

    public function useTip(bool $tip)
    {
        $this->tip = $tip;
    }

    public function prepare()
    {
        $this->label($this->field_label);

        if (!empty($this->field_label)) {
            $this->{'placeholder'} = strtolower($this->field_label);
        }

        if ($this->max_length and method_exists($this, 'setMaxLength')) {
            $this->setMaxLength($this->max_length);
            $this->addValidation($this->getLabel(), new MaxLengthValidator($this->max_length));
        }

        if ($this->required) {
            $this->setProperty('required', 'required');
            $this->addValidation($this->getLabel(), new RequiredValidator());
        }

        if ($this->tip) {
            $this->setTip(parent::getLabel());
        }
    }

    public function setValueTest($string)
    {
        parent::setValue($string);
    }

    public function disable($disable = true)
    {
        $this->field_disabled = $disable;

        if ($disable) {
            $this->class = 'tfield_disabled';
            $this->readonly = '1';
        }
    }

    public function isDisabled()
    {
        return $this->field_disabled;
    }

    public function setType(FieldTypeInterface $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function label($label, string $class = null)
    {
        $label = ucfirst($label);
        $this->setLabel($label);
        $this->field_label = $label;
        if ($class) {
            $this->label_class = $class;
        }
    }

    public function getLabel()
    {
        $label = $this->wrapperStringClass(parent::getLabel());

        return  $label;
    }

    public function setReferenceName($reference_name)
    {
        $this->reference_name = $reference_name;
        return $this;
    }

    public function getReferenceName()
    {
        return $this->reference_name;
    }

    public function getHideInEdit()
    {
        return $this->hide_in_edit;
    }

    public function setValue(?string $value)
    {
        if (empty($value)) {
            return;
        }
        if (method_exists($this, 'sanitize')) {
            $value = $this->sanitize($value);
        }
        parent::setValue($value);
    }

    public function show()
    {
        try {
            $this->prepare();

            if (!$this->use_label_field) {
                $this->showField();
                return;
            }
        } catch (\Exception $e) {
            $msg = 'Houve um problema na construção do campo ' . $this->getName();
            if (Environment::isDevelopment()) {
                $msg .= "<br>Msg: ".$e->getMessage();
                $msg .= "<br>File: ".$e->getFile().' Line :'.$e->getLine();
                $msg .= "<br>Code: ".$e->getCode();
            }
            throw new \Exception($msg);
        }
    }

    protected function getFieldInfoValidationErrorData(string $label = null)
    {
        $field_info = false;
        if (in_array(FormFieldValidationTrait::class, array_keys((new \ReflectionClass(self::class))->getTraits()))) {
            if ($this->error_msg) {
                $this->setErrorValidationSession();
                $parameters = ['field' => $this->getName(), 'form' => $this->getFormName()];

                if (USE_ROUTE) {
                    $route_base = http()->attr('route_base');
                    $route = urlRoute($route_base.'/show_error', $parameters);
                    $route .= '&static=1';

                    $field_info['route'] = $route;
                    $field_info['title'] = 'Clique para ver a mensagem';
                }
                $field_info['msg'] = implode("<br>", $this->error_msg);
                $field_info['label'] = $label;
            }
        }
        return $field_info;
    }

    /**
     * @param $label
     * @return string
     */
    protected function wrapperStringClass($label): string
    {
        $fc = mb_strtoupper(mb_substr($label, 0, 1));
        $label = $fc . mb_substr($label, 1);

        if (!empty($this->label_class)) {
            $class = ' class="dvi_str_' . $this->label_class . '"';
            $label = '<b>' . $label . '</b>';
            $label = '<span' . $class . '>' . $label . '</span>';
        }
        return $label;
    }

    protected function showField()
    {
        if (method_exists(self::class, 'showView')) {
            $this->showView();
            return;
        }
        parent::show();
    }

    public function placeholder(string $text)
    {
        $this->placeholder = $text;
    }
}
