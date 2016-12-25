<?php

namespace Karakhanyans\Comparison;

use Karakhanyans\Comparison\Traits\CompareFilesTrait;
use Karakhanyans\Comparison\Traits\CompareImagesTrait;

class Compare
{
    use CompareImagesTrait,CompareFilesTrait;
    
    public function images($a,$b)
    {
        return $this->compareImages($a,$b);
    }
    public function files($a,$b){
        return $this->compareFiles($a,$b);
    }

    public function texts($a,$b){
        return $this->compareFiles($a,$b);
    }
}
