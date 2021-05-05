# StringMax

Singleton class for string formating and templating.

# Install
```ruby
composer require jxcodes/php-string-max
````

# Usage:
```php
require __DIR__ . '/../vendor/autoload.php';

use Jxcodes\StringMax;
````
Example 1:
```php
echo StringMax::format(
    'Hi {{name}}, keep {{tip}}!',
    [
        'name' => 'developer',
        'tip' => 'building'
   ]
);
// prints: Hi developer, keep building!
```

Example 2:
```php
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
/*
Results:
$result = [
        'Hi developer, remember to be nice.',
        'Because people love nice friends',
        'and' => [
            'the world is better if we have more friends.'
        ]
]
*/
```
