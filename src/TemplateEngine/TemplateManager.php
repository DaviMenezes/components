<?php

namespace Dvi\Component\TemplateEngine;

use eftec\bladeone\BladeOne;

class TemplateManager
{
    public static function bladeOne(string $view_path = null, string $cache_path = null, string $mode = null)
    {
        $view_path = $view_path ?? './vendor/dvi/components/src';
        $cache_path = $cache_path ?? './app/view/cache';
        $mode = $mode ?? BladeOne::MODE_AUTO;
        BladeOneInstance::paths($view_path, $cache_path, $mode);
    }
}