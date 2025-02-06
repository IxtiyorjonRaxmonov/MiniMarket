<?php
namespace App\Http\Interface;


interface IncomeInterface{
    public function index();
    public function store($request);
}