<?php
namespace App\Http\Interface;

interface ProductInterface {

    public function index();
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}
