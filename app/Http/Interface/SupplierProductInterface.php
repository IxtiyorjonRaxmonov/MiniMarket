<?php
namespace App\Http\Interface;


interface SupplierProductInterface{
    public function index();
    public function store();
    public function update();
    public function destroy();
}