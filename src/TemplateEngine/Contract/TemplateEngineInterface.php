<?php

namespace Dvi\Component\TemplateEngine\Contract;

interface TemplateEngineInterface
{
    public static function instance();
    public static function run($view, $data);
}
