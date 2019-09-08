
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

After you install the package you can use the power of metadata in your models. Let's assume we want to extends our `Article` instance with specific SEO metadata values.

```php

$article = Article::findOrFail(1);

$data = [
    'seo_title' => 'My SEO title',
    'seo_description' => 'My SEO description',
    'seo_canonical' => 'https://canonical/link'
];
$article->wing()->create([ 'metadata' => $data ]);

// or use the shortcut
$article->addWing($data);

```
