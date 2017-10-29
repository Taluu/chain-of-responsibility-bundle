Chain of Responsibility Bundle
==============================
A simple bundle that helps to integrate a
[chain of responsibility pattern](https://en.wikipedia.org/wiki/Chain-of-responsibility_pattern)
through Symfony (3.3 and onwards supported). PHP 7.1 is a requirement.

To install it through composer, you just need to require the
`taluu/chain-of-responsibility-bundle` package. Other methods (zip, ... and so
on) are supported but you're on your own. :P

Howto
-----
To declare a chain of responsibility, each items *must* implement the
`ChainOfResponsibility\LinkInterface` interface, declaring a successor (if there
is one). How the object is executed is your concern. :}

An `AbstractLink` is given if you want to just implement a simple Chain of
Responsibility pattern. Just extend it, and just implement the `doHandle` method.

Once you have your chained services, all you have to do is specify them in the
bundle's configuration :

```yaml
chain_of_responsibility:
    my_first_chain:
        - foo_service
        - Bar\Baz
        # - ...

    my_second_chain:
        - Bar\Baz
        - baz_service
        # - ...

    # ... and so on
```

The items are services identifiers, so these should be declared.

### Injecting Chains
In the case you would want to inject the chains, the tip of each chain is
aliased to a `chain_of_responsibility.chains.{{ name }}` (e.g 
`chain_of_responsibility.chains.my_first_chain`). So use that identifier to
inject the correct chain.

Tests
-----
Tested through PHPUnit 6. So just run the tests and it should be all green. :}
