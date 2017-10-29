<?php
namespace ChainOfResponsibilityBundle;

interface LinkInterface
{
    public function handle(DataInterface $data): void;
    public function setSuccessor(?self $successor): void;
}
