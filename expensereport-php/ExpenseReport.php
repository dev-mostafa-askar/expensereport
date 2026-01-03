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

class ExpensesData 
{
    public function __construct(public $mealExpense, public $total, public array $expensesData) {}
}

class ExpenseData 
{
    public function __construct (
        public $type,
        public $amount, 
        public $name,
        public $marker
    ) {}
}

class ExpenseReport 
{

    function getReportData($expenses)
    {
        $expensesItems = [];
        $mealExpenses = 0;
        $total = 0;
        foreach ($expenses as $expense) {
            $mealExpenses += $this->getMealExpenses($expense);
            $total += $expense->amount;
            
            $expensesItems [] = new ExpenseData(
                $expense->type,
                $expense->amount,
                $this->getExpenseName($expense->type),
                $this->getMealOverExpensesMarker($expense)
            );
        }
        return new ExpensesData($mealExpenses, $total, $expensesItems);
    }
    function print_report($expenses) 
    {
        $date = date("Y-m-d h:i:sa");
        print("Expense Report {$date}\n");
        $expensesData = $this->getReportData($expenses);
        foreach ($expensesData->expensesData as $expense) {        
            print($expense->name . "\t" . $expense->amount . "\t" . $expense->marker . "\n");
        }
        print("Meal Expenses: " . $expensesData->mealExpense . "\n");
        print("Total Expenses: " . $expensesData->total . "\n");
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
