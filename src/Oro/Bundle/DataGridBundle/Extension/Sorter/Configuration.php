<?php

namespace Oro\Bundle\DataGridBundle\Extension\Sorter;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Oro\Bundle\DataGridBundle\Extension\Formatter\Property\PropertyInterface;

class Configuration implements ConfigurationInterface
{
    const SORTERS_PATH         = '[sorters]';
    const COLUMNS_PATH         = '[sorters][columns]';
    const MULTISORT_PATH       = '[sorters][multiple_sorting]';
    const DEFAULT_SORTERS_PATH = '[sorters][default]';
    const TOOLBAR_SORTING_PATH = '[sorters][toolbar_sorting]';

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('sorters')
            ->children()
                ->arrayNode('columns')
                    ->prototype('array')
                        ->children()
                            ->scalarNode(PropertyInterface::DATA_NAME_KEY)->isRequired()->end()
                            ->booleanNode(PropertyInterface::DISABLED_KEY)->end()
                            ->scalarNode(PropertyInterface::TYPE_KEY)->end()
                            ->variableNode('apply_callback')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('default')
                    ->prototype('enum')
                        ->values([OrmSorterExtension::DIRECTION_DESC, OrmSorterExtension::DIRECTION_ASC])->end()
                    ->end()
                    ->booleanNode('multiple_sorting')->end()
                    ->booleanNode('toolbar_sorting')->end()
                ->end()
            ->end();

        return $builder;
    }
}
