<?php

abstract class ExpenseType 
{
    const DINNER = 1;
    const BREAKFAST = 2;
    const CAR_RENTAL = 3;
}

class Expense 
{
    public $type;
    public $amount;
    function __construct($type, $amount) {
        $this->type = $type;
        $this->amount = $amount;
    }
}

class ExpenseReport 
{
    function print_report($expenses) 
    {
        $date = date("Y-m-d h:i:sa");
        print("Expense Report {$date}\n");
        
        $mealExpenses = $this->getTotalMealExpenses($expenses);
        
        foreach ($expenses as $expense) {        
            $mealOverExpensesMarker = $this->getMealOverExpensesMarker($expense);
            print($this->getExpenseName($expense->type) . "\t" . $expense->amount . "\t" . $mealOverExpensesMarker . "\n");
        }
        print("Meal Expenses: " . $mealExpenses . "\n");
        print("Total Expenses: " . $this->getTotal($expenses) . "\n");
    }

    private function getTotalMealExpenses($expenses)
    {
        $mealExpenses = 0;
        foreach ($expenses as $expense) {
            $mealExpenses += $this->getMealExpenses($expense);
        }
        return $mealExpenses;
    }

    private function getTotal($expenses)
    {
        $total = 0;
        foreach ($expenses as $expense) {
            $total += $expense->amount;
        }
        return $total;
    }

    private function getExpenseName($expenseType)
    {
        switch ($expenseType) {
            case ExpenseType::DINNER: return "Dinner";
            case ExpenseType::BREAKFAST: return "Breakfast";;
            case ExpenseType::CAR_RENTAL: return "Car Rental"; ;
        }
    }

    private function getMealExpenses($expense)
    {
        if ($expense->type == ExpenseType::DINNER || $expense->type == ExpenseType::BREAKFAST) {
            return $expense->amount;
        }
    }

    private function getMealOverExpensesMarker($expense)
    {
        if($expense->type == ExpenseType::DINNER && $expense->amount > 5000){
            return "X";
        }

        if($expense->type == ExpenseType::BREAKFAST && $expense->amount > 1000){
            return "X";
        }   
        return " ";
    }
}
