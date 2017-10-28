<?php
namespace ChainOfResponsabilityBundle;

interface LinkInterface
{
    public function handle(DataInterface $data): void;
    public function setSuccessor(?self $successor): void;
}
