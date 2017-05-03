<?php

function view($view, $vars = [])
{
    foreach ($vars as $name => $val) {
        $$name = $val;
    }

    include 'app/views/' . str_replace('.', '/', $view) . '.view.php';
}

function dd($mixed)
{
    echo '<pre>';
    var_dump($mixed);
    die(1);
}
