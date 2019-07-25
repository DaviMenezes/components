<?php

namespace Dvi\Component\TemplateEngine;

use Dvi\Component\TemplateEngine\Contract\TemplateEngineInterface;

class TemplateEngine
{
    /**@param \Dvi\Component\TemplateEngine\Contract\TemplateEngineInterface|string $class
     * @return \Dvi\Component\TemplateEngine\Contract\TemplateEngineInterface
     */
    public static function instance(string $class)
    {
        return $class::instance();
    }
}
