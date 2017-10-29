<?php
namespace ChainOfResponsibilityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('chain_of_responsibility');

        $this->addIdentifierChainNode($rootNode);

        return $treeBuilder;
    }

    private function addIdentifierChainNode(ArrayNodeDefinition $root)
    {
        $root
            ->children()
                ->arrayNode('chains')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->scalarPrototype()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
