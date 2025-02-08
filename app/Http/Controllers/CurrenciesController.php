<?php

namespace App\Http\Controllers;

use App\Http\Interface\CurrencyInterface;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{

    public function __construct(private CurrencyInterface $currency) {}
    public function index()
    {
        return $this->currency->index();
        // $repsonse = $this->checkAdmin();
        // if ($repsonse) {
        // } else {
            // return response()->json(['Forbidden'], 403);
        // }
    }


    public function store(Request $request)
    {
        return $this->currency->store($request);
    }


    public function update(Request $request, string $id)
    {
        return $this->currency->update($request, $id);
    }


    public function destroy(string $id)
    {
        return $this->currency->destroy($id);
    }
}
