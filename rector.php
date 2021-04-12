<?php

declare(strict_types=1);

use Rector\Set\ValueObject\SetList;
use Rector\Core\Configuration\Option;
use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveCodeAfterReturnRector;
use Rector\Php74\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;
use Rector\Naming\Rector\Property\UnderscoreToCamelCasePropertyNameRector;
use Rector\Naming\Rector\Variable\UnderscoreToCamelCaseLocalVariableNameRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/database/factories',
    ]);

    $parameters->set(Option::SETS, [
        SetList::CODE_QUALITY,
        SetList::LARAVEL_60,
        SetList::DEAD_CODE,
        SetList::CODING_STYLE,
        SetList::PHP_74,
    ]);

    $parameters->set(Option::SKIP, [
        __DIR__ . 'app/Providers/AppServiceProvider',
        RemoveCodeAfterReturnRector::class,
        UnderscoreToCamelCasePropertyNameRector::class,
        UnderscoreToCamelCaseLocalVariableNameRector::class,
        ArraySpreadInsteadOfArrayMergeRector::class,
        UnSpreadOperatorRector::class,
    ]);
};
