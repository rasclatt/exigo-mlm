<?php
namespace Exigo\Interfaces;

interface Database
{
    public function query(string $sql, array $bind = null): self;

    public function getResults(bool $returnSingle = false);
}