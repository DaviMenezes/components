<?php

namespace Dvi\Component\TemplateEngine;

use Dvi\Component\TemplateEngine\Contract\TemplateEngineInterface;
use eftec\bladeone\BladeOne;

class BladeOneInstance implements TemplateEngineInterface
{
    /**@var BladeOne*/
    protected static $instance;
    private static $view_path;
    private static $cache_path;
    private static $mode;

    public static function instance()
    {
        return self::$instance = self::$instance ?? new BladeOne(self::$view_path, self::$cache_path, self::$mode);
    }

    public static function run($view, $data)
    {
        self::$instance->run($view, $data);
    }

    public static function paths(string $view_path, string $cache_path, string $mode)
    {
        self::$view_path = $view_path;
        self::$cache_path = $cache_path;
        self::$mode = $mode;
    }
}
