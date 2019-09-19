<?php

namespace Dvi\Component\TemplateEngine;

use Dvi\Component\TemplateEngine\Contract\TemplateEngineInterface;
use eftec\bladeone\BladeOne;

class BladeOneInstance implements TemplateEngineInterface
{
    /**@var BladeOne*/
    protected static $instance;
    private static $view_path;
    private static $custom_view_path;
    private static $view;
    private static $cache_path = './app/view/cache';
    private static $mode = BladeOne::MODE_AUTO;

    #region [SETTERS]
    public static function setMode($mode)
    {
        self::$mode = $mode;
    }

    public static function setCachePath($path)
    {
        self::$cache_path = $path;
    }

    public static function setDefaultViewPath($path)
    {
        self::$view_path = $path;
    }

    public static function setCustomViewPath($path)
    {
        self::$custom_view_path = $path;
    }

    public static function setView($view)
    {
        self::$view = $view;
    }
    #endregion

    public static function instance()
    {
        self::$instance = self::$instance ?? new BladeOne(self::$view_path, self::$cache_path, self::$mode);
        if (file_exists(self::$custom_view_path.'/'.self::$view)) {
            self::$instance->setPath(self::$custom_view_path, self::$cache_path);
        }
        return self::$instance;
    }

    public static function run($view, $data)
    {
        self::$instance->run($view, $data);
    }
}
