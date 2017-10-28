<?php
namespace ChainOfResponsabilityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use ChainOfResponsabilityBundle\DependencyInjection\Compiler\ChainPass;

class ChainOfResponsabilityBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ChainPass);
    }
}
