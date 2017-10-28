<?php
namespace ChainOfResponsabilityBundle;

/** Base class implementation for a Chain Responsibility object */
abstract class AbstractLink implements LinkInterface
{
    /** @var LinkInterface */
    private $successor;

    public function handle(DataInterface $data): void
    {
        $continue = $this->doHandle($data);

        if ($continue && null !== $this->successor) {
            $this->successor->handle($data);
        }
    }

    abstract protected function doHandle(DataInterface $data): bool;

    public function setSuccessor(?LinkInterface $successor): void
    {
        $this->successor = $successor;
    }
}
