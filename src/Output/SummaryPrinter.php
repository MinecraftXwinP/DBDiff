<?php namespace DBDiff\Output;
use DBDiff\Diff\AlterTableDropKey;
use DBDiff\Diff\AlterTableDropConstraint;
use DBDiff\Diff\AlterTableDropColumn;
use DBDiff\Diff\AlterTableChangeColumn;
use DBDiff\Diff\AlterTableAddKey;
use DBDiff\Diff\AlterTableAddColumn;
use Diff\DiffOp\DiffOpAdd;
use Diff\DiffOp\DiffOpRemove;
use Diff\DiffOp\DiffOpChange;
class SummaryPrinter implements DiffOutput {
    public function output($schemaDiff, $dataDiff) {
        foreach($schemaDiff as $diffResult) {
            if (!empty($diffResult->diff)) {
                $diff = $diffResult->diff;
                echo "Table: $diffResult->table\n";
                if ($diff instanceof DiffOpRemove || $diff instanceof DiffOpChange) {
                    self::printRemove($diff->getOldValue());
                }
                if ($diff instanceof DiffOpAdd || $diff instanceof DiffOpChange) {
                    self::printAdd($diff->getNewValue());
                }
            }
        }
    }
    
    private static function printAdd($message) {
        echo "\033[0;32m+ $message\033[0m\n";
    }
    private static function printRemove($message) {
        echo "\033[0;31m- $message\033[0m\n";
    }

    private static function printChange($from, $to) {
        self::printRemove($from);
        self::printAdd($to);
    }


}