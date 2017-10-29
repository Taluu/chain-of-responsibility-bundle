<?php
namespace ChainOfResponsibilityBundle;

/** Base class implementation for a Chain Responsibility object */
abstract class AbstractLink implements LinkInterface
{
    /** @var LinkInterface */
    private $successor;

    /**
     * Handle the given data, and call the successor.
     *
     * It internally calls the doHandle implementation and the successor if
     * defined.
     */
    final public function handle(DataInterface $data): void
    {
        $continue = $this->doHandle($data);

        if ($continue && null !== $this->successor) {
            $this->successor->handle($data);
        }
    }

    /**
     * Does the actual handling.
     *
     * @return bool Should the chain be stopped ?
     */
    abstract protected function doHandle(DataInterface $data): bool;

    final public function setSuccessor(?LinkInterface $successor): void
    {
        $this->successor = $successor;
    }
}
