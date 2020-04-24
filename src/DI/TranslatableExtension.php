<?php

declare( strict_types=1 );

/*
 * Copyright (c) 2020 Martin Adamec (https://adamecmartin.cz)
 */

namespace MartinAdamec\DoctrineBehaviors\DI;

use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;
use Nette\Utils\AssertionException;
use Nette\Utils\Validators;


final class TranslatableExtension extends AbstractBehaviorExtension
{

	/**
	 * @var array
	 */
	private array $default = [
		'currentLocaleCallable' => null,
		'defaultLocaleCallable' => null,
		'translatableType' => TranslatableTrait::class,
		'translationType' => TranslationTrait::class,
		'translatableFetchMode' => 'LAZY',
		'translationFetchMode' => 'LAZY',
	];


	/**
	 * @inheritDoc
	 * @throws AssertionException
	 */
	public function loadConfiguration()
	{
		$config = array_merge($this->default, $this->getConfig());
		$this->validateConfigTypes($config);
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('listener'))
			->setType(TranslatableTrait::class, [
				'@' . $this->getClassAnalyzer()->getType(),
				$config[ 'currentLocaleCallable' ],
				$config[ 'defaultLocaleCallable' ],
				$config[ 'translatableType' ],
				$config[ 'translationType' ],
				$config[ 'translatableFetchMode' ],
				$config[ 'translationFetchMode' ],
			])
			->setAutowired(false);
	}


	/**
	 * @throws AssertionException
	 */
	private function validateConfigTypes(array $config)
	{
		Validators::assertField($config, 'currentLocaleCallable', 'null|array');
		Validators::assertField($config, 'translatableType', 'type');
		Validators::assertField($config, 'translationType', 'type');
		Validators::assertField($config, 'translatableFetchMode', 'string');
		Validators::assertField($config, 'translationFetchMode', 'string');
	}

}
