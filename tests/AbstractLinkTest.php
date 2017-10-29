<?php
namespace ChainOfResponsibilityBundle;

use Countable;
use PHPUnit\Framework\TestCase;

class AbstractLinkTest extends TestCase
{
    public function test_it_calls_successor()
    {
        $link = new class extends AbstractLink {
            public function doHandle(DataInterface $data): bool
            {
                $data->doSomething();

                return true;
            }
        };

        $link->setSuccessor(
            new class extends AbstractLink {
                protected function doHandle(DataInterface $data): bool
                {
                    $data->doSomething();

                    return true;
                }
            }
        );

        $data = new class implements DataInterface, Countable {
            private $calls = 0;

            public function doSomething(): void
            {
                ++$this->calls;
            }

            public function count(): int
            {
                return $this->calls;
            }
        };

        $link->handle($data);

        $this->assertCount(2, $data);
    }

    public function test_it_stops_on_false()
    {
        $link = new class extends AbstractLink {
            public function doHandle(DataInterface $data): bool
            {
                $data->doSomething();

                return false;
            }
        };

        $link->setSuccessor(
            new class extends AbstractLink {
                protected function doHandle(DataInterface $data): bool
                {
                    $data->doSomething();

                    return true;
                }
            }
        );

        $data = new class implements DataInterface, Countable {
            private $calls = 0;

            public function doSomething(): void
            {
                ++$this->calls;
            }

            public function count(): int
            {
                return $this->calls;
            }
        };

        $link->handle($data);

        $this->assertCount(1, $data);
    }
}
