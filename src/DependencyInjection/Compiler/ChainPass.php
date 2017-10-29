<?php
namespace ChainOfResponsabilityBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

use ChainOfResponsabilityBundle\LinkInterface;
use ChainOfResponsabilityBundle\DependencyInjection\ChainOfResponsabilityExtension;

class ChainPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $links = $container->getParameter(ChainOfResponsabilityExtension::PARAMETER_CHAIN_LINKS);
        $tip = array_shift($links);

        // no tip... no chain
        if (null === $tip) {
            return;
        }

        $previous = $container->getDefinition($tip);

        $tip = new Alias($tip);
        $tip->setPublic(false);

        $container->setAlias(LinkInterface::class, $tip);

        foreach ($links as $link) {
            $link = $container->getDefinition($link);

            $previous->addMethodCall('setSuccessor', [$link]);
            $previous = $link;
        }
    }
}
