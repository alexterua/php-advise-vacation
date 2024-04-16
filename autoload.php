<?php

function my_autoloader($className): void
{
    require __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
}
