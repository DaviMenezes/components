<?php

namespace Dvi\Component\TemplateEngine;

use Dvi\Component\TemplateEngine\Contract\TemplateEngineInterface;

class TemplateEngine
{
    /**@param TemplateEngineInterface|string $class
     * @return TemplateEngineInterface
     */
    public static function instance(string $class)
    {
        return $class::instance();
    }
}
