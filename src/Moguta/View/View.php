<?php

namespace Moguta\View;

class View
{
    private $templatePath;

    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }


    public function renderHtml(string $templateName, array $vars = [])
    {
//        http_response_code($code);

        extract($vars);
        ob_start();
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}