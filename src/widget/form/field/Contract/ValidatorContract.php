<?php

namespace Dvi\Component\Widget\Form\Field\Contract;

/**
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 */
interface ValidatorContract
{
    public function isValid($param):bool;

    public function validate(string $label, $value, array $parameters = null):bool;

    public function setParameters(array $parama);

    public function getErrorMsg();
}
