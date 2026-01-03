<?php

class ExpensesData 
{
    public function __construct (
        public $mealExpense, 
        public $total, 
        public array $expensesData
    ) {}
}