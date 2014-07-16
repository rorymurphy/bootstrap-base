<?php

function render_view($fileRef, $viewName, $model){
    $dirName = dirname($fileRef);
    $viewFile = $dirName . '/views/' . $viewName . '.php';
    include_once $viewFile;
    plugin_view($model);
    
}

