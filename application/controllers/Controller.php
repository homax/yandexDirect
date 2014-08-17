<?php

abstract class Controller
{


    protected function Template($fileName, $vars = array())
    {
        // Установка переменных для шаблона.
        foreach ($vars as $k => $v)
        {
            $$k = $v;
        }

        // Генерация HTML в строку.
        ob_start();
        include "application/views/$fileName";
        return ob_get_clean();
    }

}
