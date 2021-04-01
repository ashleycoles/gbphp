# GBPHP

PHP the way god intended.

A simple 'compiler' that converts GBPHP (Great British PHP) into vanilla PHP.

Inspired by Dave Childs article [If PHP Were British](https://aloneonahill.com/blog/if-php-were-british)

## Installation

1) Put the kettle on
2) Clone the repo
3) Put teabag in mug
4) Run `composer install`
5) Add hot water to mug
6) Update gbphp-config.json so the input directory (the location of the .gbphp files) and output directory (where the compiled php files are saved) are correct for your project
7) Remove teabag, add sugar and milk to taste
8) run `php compile-gbphp.php` to compile
9) Enjoy

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

```php
£variable = 'Hello World';
```

### If statements

```php
perchance (£name == 'Ash') {
    announce 'Hi' . £name;
} otherwise {
    announce 'Who are you??';
}
```

### Switches

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

```php
merry_go_round (['a', 'b', 'c'] as £item) {
    announce £item;
}
```

### Try/Catch blocks

```php
would_you_mind {
    // Thingy
} actually_i_do_mind(Wobbly £error) {
    echo £error->getMessage();
}
```

### Classes

```php
upper_class Example {
    state £a;
    private £b;
    hereditary £c;
}
```

### Super Globals

```php
£_BISCUIT // $_COOKIE
£_ROYAL_MAIL // $_POST
£_BUTLER // $_SERVER
```

### Misc

```php
serve_biscuit('name', 'content'); // setcookie();
perish(); // die();
brexit(); // exit();
does_the_array_contain(); // in_array();
```
