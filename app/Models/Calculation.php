<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calculation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['principal', 'rate', 'length', 'payment'];

    public function calculatePayment()
    {
        $r = $this->convertYearlyRateToMonthlyRate();
        $n = $this->convertLengthToMonths();
        $t = pow(1 + $r, $n);
        $payment = $this->principal * (( $r * $t )/( $t - 1 ));
        $this->payment = ceil($payment * 100 ) / 100;
        return $this->payment;
    }
    
    private function convertYearlyRateToMonthlyRate() 
    {
        return $this->convertRateToDecimal($this->rate)/12;
    }

    private function convertRateToDecimal() 
    {
        return $this->rate/100;
    }

    private function convertLengthToMonths() 
    {
        return $this->length * 12;
    }

}
