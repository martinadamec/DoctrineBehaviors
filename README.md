# Doctrine Behaviors

[![Latest stable](https://img.shields.io/packagist/v/martinadamec/doctrine-behaviors.svg?style=flat-square)](https://packagist.org/packages/martinadamec/doctrine-behaviors)


Port of [KnpLabs/DoctrineBehaviors](https://github.com/KnpLabs/DoctrineBehaviors) to Nette DI

Supported behaviors:

- Translatable


## Install

Via Composer:

```sh
$ composer require martinadamec/doctrine-behaviors
```

Register extensions you need in `config.neon`:

```yaml
extensions:
	translatable: Zenify\DoctrineBehaviors\DI\TranslatableExtension
```


## Usage

### Translatable

Setup your translator locale callback in `config.neon`:

```yaml
translatable:
	currentLocaleCallable: [@Translator, getLocale]
```

Place trait to your entity:

```php
class Article
{
	
	use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
	// returns translated property for $article->getTitle() or $article->title
	use MartinAdamec\DoctrineBehaviors\Entities\Attributes\Translatable;

}
```

And its translation entity:

```php
class ArticleTranslation
{
	
	use Knp\DoctrineBehaviors\Model\Translatable\Translation;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	public $title;

}
```

