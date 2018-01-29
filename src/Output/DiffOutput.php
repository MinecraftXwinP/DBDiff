<?php namespace DBDiff\Output;
interface DiffOutput {
    public function output($schemaDiff, $dataDiff);
}