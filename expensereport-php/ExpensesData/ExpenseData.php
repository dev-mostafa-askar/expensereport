<?php 

class ExpenseData 
{
    public function __construct (
        public $type,
        public $amount, 
        public $name,
        public $marker
    ) {}
}