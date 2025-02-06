<?php
namespace App\Http\Interface;


interface MeasurementInterface{
    public function index();
    public function store();
    public function update();
    public function destroy();
}