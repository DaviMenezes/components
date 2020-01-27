<?php

namespace Dvi\Component\Widget\Form\Field\Contract;

/**
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)
 * @see https://github.com/DaviMenezes
 */
interface FormComponentEventContract
{
    public function createFieldActions(): void;
}
