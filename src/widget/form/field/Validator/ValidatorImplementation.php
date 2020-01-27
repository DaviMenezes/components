<?php

namespace Dvi\Component\Widget\Form\Field\Validator;

/**
 * Validator FieldValidator
 *
 * @package    Validator
 * @subpackage Field
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
trait ValidatorImplementation
{
    protected $label;
    protected $value1;
    protected $value2;
    protected $error_msg;
    protected $error_msg_default;

    public function __construct(string $error_msg = null)
    {
        $this->error_msg = $error_msg ?? 'Valor inválido';
    }

    public function getErrorMsg()
    {
        return $this->error_msg;
    }

    public function setParameters($params)
    {
        $this->setDefaultValues($params);
    }

    protected function setDefaultValues($params): void
    {
        $this->label = $params['label'] ?? $this->label;
        $this->value1 = $params['value'] ?? $this->value1;
        $this->value2 = $params['value2'] ?? $this->value2;
        $this->error_msg = $params['msg'] ?? $this->error_msg;
    }

    public function isValid($param):bool
    {
        return true;
    }
}
