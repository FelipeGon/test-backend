<?php

namespace App\Enums;

class AvlNodeEnum
{
    public $value;
    public $left;
    public $right;
    public $height;

    function __construct($value) {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }
}
