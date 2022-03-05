<?php

namespace App\Imports;

use App\Models\Organization;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
  

class OrganizationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Organization([
            'name'      => $row['name'],
            'address'   => $row['address'], 
            'country_id'   => $row['country'],
            'state'     => $row['state'],
            'city'      => $row['city'],
            'postalcode' => $row['postalcode'],
            'created_by' => auth()->id(),
        ]);
    }
}
