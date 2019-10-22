# GBPHP

PHP the way god intended.

A simple 'compiler' that converts GBPHP (Great British PHP) into vanilla PHP.

## Installation

1) Put the kettle on
2) Clone the repo
3) Put teabag in mug and add hot water
4) Run `npm install`
5) Remove teabag, add sugar and milk to taste
6) Update gbphp-config.json so the input directory (the location of the .gbphp files) and output directory (where the compiled php files are saved) are correct for your project
7) run `gulp watch` to auto-compile your gbphp, or `gulp compile-gbphp` to compile a single time

## Language Usage Examples

#### Vanilla PHP
```php
<?php
if ($name == 'Ash') {
    echo 'Hi' . $name;
} else {
    echo 'Who are you??';
}
```

#### GBPHP
```php
<?gbphp
perchance ($name == 'Ash') {
    announce 'Hi' . £name;
} otherwise {
    announce 'Who are you??';
}
```

#### Vanilla PHP
```php
<?php
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

#### GBPHP
```php
<?gbphp
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