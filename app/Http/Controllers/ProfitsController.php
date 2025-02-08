<?php

namespace App\Http\Controllers;

use App\Http\Interface\ProfitInterface;
use App\Models\Profit;
use Illuminate\Http\Request;

class ProfitsController extends Controller
{
    public function __construct(private ProfitInterface $profitInterface)
    {
        
    }
    public function index (Request $request){
        return $this->profitInterface->index($request);

    }

    public function indexTotal (Request $request){
        return $this->profitInterface->indexTotal($request);

    }
}
