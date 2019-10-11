<?php

namespace Dvi\Component\Widget\Form\Field;

/**
 *  BaseComponentTrait
 *
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 */
trait BaseComponentTrait
{
    protected $properties = [];
    protected $params = [];

    public function showView()
    {
        $this->prepareParams();

        echo $this->getView($this->params);
    }

    public function prepareParams()
    {
        $this->params = $this->prepareViewParams();

        $this->properties = collect($this->properties)->merge($this->tag->getProperties())->all();

        if (!empty($this->size)) {
            $width = strstr($this->size, '%') === false ? 'px' : '';
            $this->properties['style'] = collect($this->properties['style'])->add("width:{$this->size}$width")->all();
        }

        $this->clearExtraParams($this->properties, $this->params);

        $this->preparePropertyValues();

        $this->params['properties'] = $this->properties;
        $this->params['has_error'] = $this->error_msg ? true : false;
        $this->params['label'] = parent::getLabel();
        $this->params['field_info'] = $this->getFieldInfoValidationErrorData($this->getLabel());

        $this->getViewCustomParameters();
    }

    public function clearExtraParams(array $properties, &$params)
    {
        foreach ($properties as $property => $value) {
            if (isset($params[$property]) and $params[$property] == $value) {
                unset($params[$property]);
            }
        }
    }

    protected function preparePropertyValues(): array
    {
        $this->properties = collect($this->properties)->map(function ($value, $property) {
            if (!is_array($value)) {
                return $value;
            }
            $result = '';
            $separator = $property == 'style' ? '; ' : ' ';
            foreach ($value as $item_key => $item) {
                $result .= $item;
                if ($item_key + 1 < count($value)) {
                    $result .= $separator;
                }
            }
            return $result;
        })->all();
        return $this->properties;
    }

    public function getViewCustomParameters()
    {
    }
}