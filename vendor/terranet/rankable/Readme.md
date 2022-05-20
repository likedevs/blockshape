# Installation

add in composer
```json
    "repositories": [
        {
            "type": "vcs",
            "url": "git@gitlab.top.md:terranet/rankable.git"
        }
    ],
    "require": {
        "terranet/rankable": "dev-master"
    }
```

```sh
composer update
```

### Usage example

```php
class Program extends Repository implements Translatable, Rankable
{
    use HasRankableField;

    // optional
    protected $rankableColumn = 'rank';

    protected $rankableIncrementValue = 2;

    protected $rankableGroupByColumn = 'member_id';
}
```

now Program::all() will contain orderBy('rank', 'asc') statement

to disable default orderBy statement use:
```php
Program::unRanked()
```

to sync rankings call:
```php
$model = new Program;
$model->syncRanking([
    1 => 3,
    2 => 2,
    3 => 1
]);
```
where key => id, value => rank