<?php
namespace ChainOfResponsabilityBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ChainOfResponsabilityExtension extends Extension
{
    const SERVICE_TEMPLATE = 'chain_of_responsability.chain.%s';
    const PARAMETER_CHAINS = 'chain_of_responsability.chains';

    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration, $configs);
        $container->setParameter(self::PARAMETER_CHAINS, $config['chains']);
    }
}
