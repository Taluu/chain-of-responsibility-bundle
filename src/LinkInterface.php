<?php
namespace ChainOfResponsibilityBundle;

interface LinkInterface
{
    public function setSuccessor(?self $successor): void;
}
