<?php

namespace App\Http\Interface;

interface UserInterface {

    public function index ();
    public function update ($request, $id);
    public function destroy ($id);
}
