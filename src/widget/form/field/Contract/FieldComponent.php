<?php

namespace Dvi\Component\Widget\Form\Field;

/**
 *  FieldComponent
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 */
interface FieldComponent
{
    public function showView();

    public function getViewCustomParameters();

    public function prepareViewParams();

    public function clearExtraParams(array $properties, &$params);

    public function getView(array $data);
}
