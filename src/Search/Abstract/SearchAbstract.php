<?php

namespace Nuclearbear\Encydb\Search\Abstract;

abstract class SearchAbstract
{
    abstract public function search(string $searchRequest, Array $where);
}