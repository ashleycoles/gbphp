# GBPHP

PHP the way god intended.

A simple 'compiler' that converts GBPHP (Great British PHP) into vanilla PHP.

Inspired by Dave Childs article [If PHP Were British](https://aloneonahill.com/blog/if-php-were-british)

## Installation

1) Put the kettle on
2) Clone the repo
3) Put teabag in mug and add hot water
4) Run `npm install`
5) Remove teabag, add sugar and milk to taste
6) Update gbphp-config.json so the input directory (the location of the .gbphp files) and output directory (where the compiled php files are saved) are correct for your project
7) run `gulp watch` to auto-compile your gbphp, or `gulp compile-gbphp` to compile a single time

## Language Usage Examples

- [Variables](#variables)
- [If statements](#if-statements)
- [Switches](#switches)
- [Foreach loops](#foreach-loops)
- [Try/Catch blocks](#trycatch-blocks)
- [Classes](#classes)
- [Super globals](#super-globals)
- [Misc](#misc)

### Variables

##### PHP
```php
$variable = 'Hello World';
```

##### GBPHP
```php
£variable = 'Hello World';
```
### If statements

##### PHP
```php
if ($name == 'Ash') {
    echo 'Hi' . $name;
} else {
    echo 'Who are you??';
}
```

##### GBPHP
```php
perchance ($name == 'Ash') {
    announce 'Hi' . £name;
} otherwise {
    announce 'Who are you??';
}
```

### Switches

##### Vanilla PHP
```php
switch ($name) {
    case 'Ash':
        echo 'Hi Ash';
        break;
    case 'Bex':
        echo 'Hi Bex';
        break;
    default:
        throw new Exception('Who the hell are you!');
        break;
}
```

##### GBPHP
```php
what_about (£name) {
    perhaps 'Ash':
        announce 'Hi Ash';
        splendid;
    perhaps 'Bex':
        announce 'Hi Bex';
        splendid;
    on_the_off_chance:
        throw new Wobbly('Who the hell are you!');
        splendid;
}
```

### Foreach loops

##### PHP
```php
foreach (['a', 'b', 'c'] as $item) {
    echo $item;
}
```

##### GBPHP
```php
merry_go_round (['a', 'b', 'c'] as £item) {
    announce £item;
}
```

### Try/Catch blocks

##### PHP
```php
try {
    // Thingy
} catch (Exception $error) {
    echo $error->getMessage();
}
```

##### GBPHP
```php
would_you_mind {
    // Thingy
} actually_i_do_mind(Wobbly £error) {
    echo £error->getMessage();
}
```

### Classes

##### PHP
```php
class Example {
    public $a;
    private $b;
    protected $c;
}
```

##### GBPHP
```php
upper_class Example {
    state £a;
    private £b;
    hereditary £c;
}
```

### Super Globals

##### PHP
```php
$_COOKIE
$_POST
$_SERVER
```

##### GBPHP
```php
£_BISCUIT
£_ROYAL_MAIL
£_BUTLER
```

### Misc

##### PHP
```php
setcookie('name', 'content');
die();
exit();
```

##### GBPHP
```php
serve_biscuit('name', 'content');
perish();
brexit();
```