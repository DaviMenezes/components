<?php

namespace Dvi\Support\View;

use Dvi\Component\TemplateEngine\BladeOneInstance;
use Dvi\Component\TemplateEngine\TemplateEngine;

class View
{
    public static function run(string $view, array $data = null)
    {
        $templateEngine = TemplateEngine::instance(BladeOneInstance::class);
        return $templateEngine->run($view, $data);
    }
}
