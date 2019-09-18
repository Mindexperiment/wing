
## Wing

> This package is a WIP, please don't use until a stable release.

Put the wings to your eloquent models.

This package let you extends your models with a set of json metadata.

### Configuration

#### Composer

Require this package inside your composer.json file

```composer

"agpretto/wing": "dev-master"

```

## Install

This package resolve the problem of adding metadata description to a model. You can assign as many value as you like for a single model to describe everything related to your model instance.

0. Install the package with `wing:install` command.

1. You only need to use the `HasWing` trait on one of your model.

```php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Agpretto\Wing\HasWing;

class Article extends Model
{
    use HasWing;
}

```

## Usage

After you install the package you can use the power of Wing for your models. We use an instance of an article model entity to expose the method of this package.

```php

// - grab an article

$article = Article::findOrFail(1);

```

### Simple data

Let's assume we want to extends our `Article` instance with a new wing simple data value.

```php

// add one simple value

$article->addWing('foo'); // extend the model with a wing

// get the value back

$value = $article->metadata(); // foo

```

### Structured data

Let's now assume we want to extends our `Article` instance with a structured data value.

```php

// structured data
$data = [
    'foo' => 'bar',
    'bar' => 'baz',
    'min' => 'max',
];
$article->addWing($data); // extend the model with a wing

// get the values back

$data = $article->metadata(); // stdClass
$data->foo; // bar
$data->bar; // baz
$data->min; // max

// directly access the data

$article->metadata()->foo; // bar
$article->metadata()->bar; // baz
$article->metadata()->min; // max

```

### Complex structured data

Please use the complex structure with caution!

Let's now assume we want to extends our `Article` instance with a complex structure of data.

```php

// structured data
$data = [
    'foo' => [ 'foo' => 'bar', 'bar' => 'baz' ],
    'bar' => 'baz',
    'a-strange-key' => [ 'only', 'value' ]
];
$article->addWing($data); // extend the model with a wing

// again, we can get the values back

$data = $article->metadata(); // stdClass
$data->foo; // stdClass
$data->foo->foo; // bar
$data->bar; // baz
$data->{'a-strange-key'}; // stdClass
$data->{'a-strange-key'}[0]; // only

// directly access the data

$article->metadata()->foo; // stdClass
$article->metadata()->foo->foo; // bar
$article->metadata()->bar; // baz
$article->metadata()->{'a-strange-key'}; // stdClass
$article->metadata()->{'a-strange-key'}[0]; // only

```

### Check data

You can check if a data exists inside your structured data by using the method `hasMetdata`.

```php

// structured data
$data = [
    'foo' => 'bar',
    'bar' => 'baz',
    'min' => 'max',
];
$article->addWing($data); // extend the model with a wing

$article->hasMetadata('foo'); // true
$article->hasMetadata('max'); // false

```

### Update data inside a wing

Because wing use json data field to store your model structured data inside the database you can use the json notation to update data for the wing relation.

You can find tons of example on how to [work with json data type](https://lmgtfy.com/?q=laravel+json+data+type).

This package provide you 2 simplified methods to update the data of your wing.

#### Update simple structured data

Use the `updateData` method to update a simple structure.

```php

// structured data
$data = [
    'foo' => 'bar',
    'bar' => 'baz',
    'min' => 'max',
];
$article->addWing($data); // extend the model with a wing

$article->metadata()->foo; // bar

// update wing data
$article->updateWing('foo', 'bong');
$article->refresh(); // reload model relations

$article->metadata()->foo; // bong

```

#### Update part of complex data structure

Use the `updatePartOfWing` to go through your data and update a part of them.

This method simplify the access to the data structure.

```php

// structured data
$data = [
    'foo' => [ 'foo' => 'bar', 'bar' => 'baz' ],
    'bar' => 'baz',
    'a-strange-key' => [ 'only', 'value' ]
];
$article->addWing($data); // extend the model with a wing

//update data using a path
$article->updatePartOfWing('foo->foo', 'bong');
$article->refresh(); // reload model relations

$article->metadata()->foo->foo; // bong

```

### Credits

This package is built for you by the Interstellar Developer [Andrea Giuseppe](https://andreagiuseppe.com) - [Github](https://github.com/Mindexperiment)
