<?php

namespace Dvi\Component\TemplateEngine;

use Dvi\Component\TemplateEngine\Contract\TemplateEngineInterface;
use eftec\bladeone\BladeOne;

class TemplateManager
{
    public static $default_view_path = './vendor/dvi/components/src';
    public static $custom_view_path = './app/view';
    private static $template;
    /**@var BladeOne*/
    private static $instance;

    public static function customViewPath($path)
    {
        self::$custom_view_path = $path;
    }

    public static function bladeOne(string $view_path = null, string $cache_path = null, string $mode = null)
    {
        $view_path = $view_path ?? self::$default_view_path;
        $cache_path = $cache_path ?? './app/view/cache';
        $mode = $mode ?? BladeOne::MODE_AUTO;
        BladeOneInstance::paths($view_path, $cache_path, $mode);
    }

    /**
     * @param string|null $template
     * @return TemplateEngineInterface
     */
    public static function template(string $template = null)
    {
        if (!$template) {
            return self::$template;
        }
        self::$template = $template;
    }

    public static function instance($view)
    {
        self::template()::setDefaultViewPath(self::$default_view_path);
        self::template()::setCustomViewPath(self::$custom_view_path);
        self::template()::setView($view);

        return self::$instance = self::template()::instance();
    }
}
