<?php

require_once 'ExpensesData/ExpenseTransformer.php';



class ExpenseReport 
{
    function print_report($expenses) 
    {
        $expensesData = (new ExpenseTransformer())->transform($expenses);
        $this->printReportInConsle($expensesData);
    }

    private function printReportInConsle($expensesData)
    {
        $date = date("Y-m-d h:i:sa");
        print("Expense Report {$date}\n");
        foreach ($expensesData->expensesData as $expense) {        
            print($expense->name . "\t" . $expense->amount . "\t" . $expense->marker . "\n");
        }
        print("Meal Expenses: " . $expensesData->mealExpense . "\n");
        print("Total Expenses: " . $expensesData->total . "\n");
    }
}
