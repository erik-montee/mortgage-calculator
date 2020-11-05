<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalculationController extends Controller
{
    protected $calculation;

    public function __construct(Calculation $calculation)
    {
        $this->calculation = $calculation;
    }

    public function all()
    {
        return $this->calculation->all();
    }

    public function delete(Request $request) 
    {
        $data = $request->all();
        $validator = Validator::make($data , [
            'ids' => 'required|array',
        ]);
        
        if ($validator->fails()) {
            return [ 'success' => 'failed', 'message' => $validator->errors()->first()] ;
        }
        $this->calculation->whereIn('id', $data['ids'])->delete();
    }

    public function calculate(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data , [
            'rate' => 'required|numeric|min:.01',
            'length' => 'required|numeric|min:1',
            'principal' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return [ 'success' => 'failed', 'message' => $validator->errors()->first()] ;
        }
        $this->calculation->rate = $data['rate'];
        $this->calculation->length = $data['length'];
        $this->calculation->principal = $data['principal'];
        $this->calculation->calculatePayment();
        $this->calculation->save();
        return $this->calculation;

    }
}
