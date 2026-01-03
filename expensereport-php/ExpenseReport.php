<?php

require_once 'ExpensesData/ExpenseTransformer.php';



class ExpenseReport 
{
    function printReport($expenses) 
    {
        $expensesData = (new ExpenseTransformer())->transform($expenses);
        $this->printReportInConsle($expensesData);
    }

    private function printReportInConsle($expenses)
    {
        $date = date("Y-m-d h:i:sa");
        print("Expense Report {$date}\n");
        foreach ($expenses->expensesData as $expense) {        
            print($expense->name . "\t" . $expense->amount . "\t" . $expense->marker . "\n");
        }
        print("Meal Expenses: " . $expenses->mealExpense . "\n");
        print("Total Expenses: " . $expenses->total . "\n");
    }
}
