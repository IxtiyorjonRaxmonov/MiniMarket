<?php

// it('has supplier page', function () {
//     $supplierData = [
//         "company_name" => fake()->company(),
//     ];

//     $response = $this->post('api/supplier', $supplierData);

//     $response->assertStatus(200);
// });

it('has supplier page', function () {
    
    $response = $this->post('api/supplier', createSupplier());

    $response->assertStatus(200);
});
