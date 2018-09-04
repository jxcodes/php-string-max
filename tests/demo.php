<?php

require __DIR__ . '/../vendor/autoload.php';

use jDelta\StringMax;

// Example 1
echo StringMax::replaceTokens(
    'Hi {{name}}, keep {{tip}}!',
    [
        'name' => 'developer',
        'tip'  => 'building'
   ]
);
// Exaple 2
$tpl = <<<HTML
<h1>Hi {{name}}.</h1>
<blockquote>{{saying}}</blockquote>
HTML;

echo StringMax::replaceTokens($tpl, [
    'name' => 'developer',
    'saying' => 'Keep simple things simple!'
]);

$result = StringMax::replaceTokensInArray([
        'Hi {{name}}, remember to be {{tip}}.',
        'Because {{myTarget}} love nice {{myTarget}}',
        'and' => [
            'the world is better if we have more {{mates}}.'
        ]
    ],
    [
        'name'      => 'developer',
        'tip'       => 'nice',
        'myTarget'  => 'people',
        'mates'     => 'friends'
    ]
);
echo '<pre>';
print_r($result);
echo '</pre>';
