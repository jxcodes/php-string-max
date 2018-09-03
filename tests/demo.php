<?php

require __DIR__ . '/../vendor/autoload.php';

use jDelta\StringMax;

// Example 1
echo StringMax::format(
    'Hi {{name}}, keep {{tip}}!',
    [
        'name' => 'developer',
        'tip' => 'building'
   ]
);
// Exaple 2
$tpl = <<<HTML
<h1>Hi {{name}}.</h1>
<blockquote>{{saying}}</blockquote>
HTML;

echo StringMax::format($tpl, [
    'name' => 'developer',
    'saying' => 'Keep simple things simple!'
]);
