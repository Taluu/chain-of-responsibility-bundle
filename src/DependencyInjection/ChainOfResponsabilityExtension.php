<?php
namespace ChainOfResponsabilityBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ChainOfResponsabilityExtension extends Extension
{
    const PARAMETER_CHAIN_LINKS = 'chain_of_responsability.links';

    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration, $configs);
        $container->setParameter(self::PARAMETER_CHAIN_LINKS, $config['chain']);
    }
}
