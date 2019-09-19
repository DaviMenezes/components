<?php

namespace Dvi\Support\View;

use Dvi\Component\TemplateEngine\BladeOneInstance;
use Dvi\Component\TemplateEngine\TemplateEngine;
use Dvi\Component\TemplateEngine\TemplateManager;
use eftec\bladeone\BladeOne;

class View
{
    protected static $base_view_path;

    public static function run(string $view, array $data = null)
    {
        $template = TemplateManager::instance($view);
        return $template->run($view, $data);
    }

    public static function customViewPath($custom_view = null)
    {
        if (!$custom_view) {
            return self::$base_view_path;
        }
        self::$base_view_path = $custom_view;
    }
}
