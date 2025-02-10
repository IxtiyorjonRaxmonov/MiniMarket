<?php

namespace App\Http\Controllers;

use App\Http\Interface\IncomeInterface;
use App\Http\Requests\IncomeRequest;
use Illuminate\Http\Request;




class IncomesController extends Controller
{
    public function __construct(
        private IncomeInterface $incomeRepository,

    )
    {
    }

    public function index()
    {
       return $this->incomeRepository->index();
    }


    public function incomeExcel(Request $request)
    {
        
       return $this->incomeRepository->incomeExcel($request);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeRequest $request)
    {
       return $this->incomeRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
