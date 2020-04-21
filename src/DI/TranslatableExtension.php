<?php

declare(strict_types=1);

/*
 * Copyright (c) 2020 Martin Adamec (https://adamecmartin.cz)
 */

namespace MartinAdamec\DoctrineBehaviors\DI;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Nette\Utils\AssertionException;
use Nette\Utils\Validators;


final class TranslatableExtension extends AbstractBehaviorExtension
{

	/**
	 * @var array
	 */
	private $default = [
		'currentLocaleCallable' => NULL,
		'defaultLocaleCallable' => NULL,
		'translatableTrait' => TranslatableInterface::class,
		'translationTrait' => TranslationInterface::class,
		'translatableFetchMode' => 'LAZY',
		'translationFetchMode' => 'LAZY',
	];


	public function loadConfiguration()
	{
		$config = $this->getConfig($this->default);
		$this->validateConfigTypes($config);
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('listener'))
			->setFactory(TranslatableInterface::class, [
				// '@' . $this->getClassAnalyzer()->getType(),
				$config['currentLocaleCallable'],
				$config['defaultLocaleCallable'],
				$config['translatableTrait'],
				$config['translationTrait'],
				$config['translatableFetchMode'],
				$config['translationFetchMode']
			])
			->setAutowired(FALSE);
	}


	/**
	 * @throws AssertionException
	 */
	private function validateConfigTypes(array $config)
	{
		Validators::assertField($config, 'currentLocaleCallable', 'null|array');
		Validators::assertField($config, 'translatableTrait', 'type');
		Validators::assertField($config, 'translationTrait', 'type');
		Validators::assertField($config, 'translatableFetchMode', 'string');
		Validators::assertField($config, 'translationFetchMode', 'string');
	}

}
