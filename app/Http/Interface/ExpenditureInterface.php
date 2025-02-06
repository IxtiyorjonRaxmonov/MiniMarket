<?php
namespace App\Http\Interface;


interface ExpenditureInterface{
    public function index();
    public function store($request);
}