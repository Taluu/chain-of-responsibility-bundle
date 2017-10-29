<?php
namespace ChainOfResponsibilityBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

use ChainOfResponsibilityBundle\LinkInterface;
use ChainOfResponsibilityBundle\DependencyInjection\ChainOfResponsibilityExtension;

class ChainPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $chains = $container->getParameter(ChainOfResponsibilityExtension::PARAMETER_CHAINS);

        foreach ($chains as $name => $links) {
            $tip = array_shift($links);

            // no tip... no chain
            if (null === $tip) {
                continue;
            }

            $previous = $container->getDefinition($tip);

            $tip = new Alias($tip);
            $tip->setPublic(false);

            $container->setAlias(sprintf(ChainOfResponsibilityExtension::SERVICE_TEMPLATE, $name), $tip);

            foreach ($links as $link) {
                $link = $container->getDefinition($link);

                $previous->addMethodCall('setSuccessor', [$link]);
                $previous = $link;
            }
        }
    }
}
