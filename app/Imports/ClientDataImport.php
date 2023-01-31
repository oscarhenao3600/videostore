<?php

namespace App\Imports;

use App\Models\ClienteDato;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientDataImport implements ToCollection
{
    /**
    * @param Collection $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $cont = 0;
        foreach ($rows as $row) 
        {
            if($cont !== 0)
            {
                $client = ClienteDato::GetInfo(null, $row[0])->first();

                if(!$client)
                {
                    ClienteDato::create([
                        'cliente_dato_num_identificacion' => $row[0],
                        'cliente_dato_nombres' => $row[1],
                        'cliente_dato_apellidos' => $row[2],
                    ]);
                }
            }

            $cont++;
        }
    }
}
