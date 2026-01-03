<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../ExpenseReport.php';

class ExpenseReportTest extends TestCase
{
    public function testExample(): void
    {
        $this->assertTrue(true);
    }

    public function testPrintReport(): void
    {
        $expenses = [
            (new Expense(ExpenseType::DINNER, 5001)),
            (new Expense(ExpenseType::BREAKFAST, 1000)),
            (new Expense(ExpenseType::CAR_RENTAL, 4000)),
        ];

        $expensesReport = new ExpenseReport();
        ob_start();
        $expensesReport->print_report($expenses);
        $output = ob_get_clean();
        
        $outputLines = explode("\n", $output);
        array_shift($outputLines); 
        $outputWithoutDate = implode("\n", $outputLines);
        
        $expectedOutput = "Dinner\t5001\tX\n" .
            "Breakfast\t1000\t \n" .
            "Car Rental\t4000\t \n" .
            "Meal Expenses: 6001\n" .
            "Total Expenses: 10001\n";
        
        $this->assertEquals($expectedOutput, $outputWithoutDate);
    }
}