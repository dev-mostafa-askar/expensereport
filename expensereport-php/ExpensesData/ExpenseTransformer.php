<?php 

require_once __DIR__ . '/ExpenseEntity.php';
require_once __DIR__ . '/ExpenseData.php';
require_once __DIR__ . '/ExpensesData.php';
require_once __DIR__ . '/ExpenseTypeEnum.php';

class ExpenseTransformer
{
    public function transform($expenses)
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

    private function getExpenseName($expenseType)
    {
        switch ($expenseType) {
            case ExpenseType::DINNER: return "Dinner";
            case ExpenseType::BREAKFAST: return "Breakfast";
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