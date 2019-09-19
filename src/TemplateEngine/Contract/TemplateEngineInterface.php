<?php

namespace Dvi\Component\TemplateEngine\Contract;

interface TemplateEngineInterface
{
    public static function instance();
    public static function run($view, $data);
    public static function setDefaultViewPath($path);
    public static function setCustomViewPath($path);
    public static function setCachePath($path);
    public static function setView($view);
}
