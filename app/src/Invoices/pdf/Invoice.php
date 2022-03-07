<?php

namespace App\src\Invoices\pdf;

interface Invoice
{
    public function printToFile(string $fileName): void;
}
