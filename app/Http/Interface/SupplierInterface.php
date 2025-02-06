<?php
namespace App\Http\Interface;


interface SupplierInterface{
    public function index();
    public function store();
    public function update();
    public function destroy();
}