Favorite
========

Installation
------------

```sh
$ composer require geniv/nette-favorite
```
or
```json
"geniv/nette-favorite": ">=1.0.0"
```

require:
```json
"php": ">=7.0.0",
"nette/nette": ">=2.4.0",
"geniv/nette-general-form": ">=1.0.0"
```

Include in application
----------------------

neon configure services:
```neon
services:
    - Favorite
```

presenter usage:
```php
protected function createComponentFavorite(Favorite $favorite): Favorite 
{
    //$otherComponent->addComponent($favorite, 'favorite');
    
    // $favorite->setTemplatePath(__DIR__ . '/templates/favorite.latte');
    $favorite->setSource($this->favoriteSource);
    $favorite->onSetFavorite[] = function (int $id) {
        $this->setFavorite($id);
    };
}
```

check status:
```php
$favorite->isFavorite($id);
```

latte usage:
```latte
{control favorite $item['id']}
```
