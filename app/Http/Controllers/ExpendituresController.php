<?php

namespace App\Http\Controllers;

use App\Http\Interface\ExpenditureInterface;
use App\Http\Requests\ExpenditureRequest;
use App\Http\Resources\ExpenditureResource;
use App\Models\CurrencyDaily;
use App\Models\Expenditure;
use App\Models\Income;
use App\Models\Markup;
use App\Models\Profit;
use App\Models\RestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ExpendituresController extends Controller
{
    public function __construct(private ExpenditureInterface $expenditureInterface) {}
    public function index()
    {
        return $this->expenditureInterface->index();
    }


    public function create()
    {
        //
    }


    public function store(ExpenditureRequest $request)
    {
        return $this->expenditureInterface->store($request);
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
