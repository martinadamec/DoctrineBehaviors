<?php

declare( strict_types=1 );

/*
 * Copyright (c) 2020 Martin Adamec (https://adamecmartin.cz)
 */

namespace MartinAdamec\DoctrineBehaviors\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Definition;


abstract class AbstractBehaviorExtension extends CompilerExtension
{

	protected function getClassAnalyzer(): Definition
	{
		$builder = $this->getContainerBuilder();

		if ( $builder->hasDefinition('knp.classAnalyzer') ) {
			return $builder->getDefinition('knp.classAnalyzer');
		}

		return $builder->addDefinition('knp.classAnalyzer')
			->setClass(ClassAnalyzer::class);
	}
}
