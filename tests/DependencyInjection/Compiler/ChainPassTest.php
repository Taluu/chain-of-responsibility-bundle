<?php
namespace ChainOfResponsibilityBundle\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;

use Prophecy\Argument;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use ChainOfResponsibilityBundle\LinkInterface;
use ChainOfResponsibilityBundle\DependencyInjection\ChainOfResponsibilityExtension;

class ChainPassTest extends TestCase
{
    public function test_no_lists_no_chains()
    {
        $container = $this->prophesize(ContainerBuilder::class);
        $container
            ->getParameter(ChainOfResponsibilityExtension::PARAMETER_CHAINS)
            ->willReturn([])
            ->shouldBeCalled()
        ;

        $container
            ->getDefinition(Argument::cetera())
            ->shouldNotBeCalled()
        ;

        $pass = new ChainPass;
        $pass->process($container->reveal());
    }

    public function test_chain_is_declared()
    {
        $barDefinition = new Definition;

        $fooDefinition = $this->prophesize(Definition::class);
        $fooDefinition
            ->addMethodCall('setSuccessor', [$barDefinition])
            ->shouldBeCalled()
        ;

        $container = $this->prophesize(ContainerBuilder::class);
        $container
            ->getParameter(ChainOfResponsibilityExtension::PARAMETER_CHAINS)
            ->willReturn(['foo' => ['bar', 'baz']])
            ->shouldBeCalled()
        ;

        $container
            ->setAlias(
                sprintf(ChainOfResponsibilityExtension::SERVICE_TEMPLATE, 'foo'),
                Argument::which('isPublic', false)
            )->shouldBeCalled()
        ;

        $container
            ->getDefinition('bar')
            ->willReturn($fooDefinition)
            ->shouldBeCalled()
        ;

        $container
            ->getDefinition('baz')
            ->willReturn($barDefinition)
            ->shouldBeCalled()
        ;

        $pass = new ChainPass;
        $pass->process($container->reveal());
    }
}
