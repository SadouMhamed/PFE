<?php

namespace App\Imports;

use App\Models\BureauDePoste;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BureauDePostesImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new BureauDePoste([
            'brigade'       => $row['brigade'] ?? null,
            'classe'        => $row['classe'] ?? null,
            'code'          => $row['code'] ?? null,
            'code_commune'  => $row['code_commune'] ?? null,
            'commune'       => $row['commune'] ?? null,
            'cp'            => $row['cp'] ?? null,
            'daira'         => $row['daira'] ?? null,
            'etat'          => $row['etat'] ?? null,
            'intitule_ar'   => $row['intitule_ar'] ?? null,
            'intitule_fr'   => $row['intitule_fr'] ?? null,
            'upw'           => $row['upw'] ?? null,
            'upw_id'        => is_numeric($row['upw_id'] ?? '') ? $row['upw_id'] : null,
            'wilaya'        => $row['wilaya'] ?? null,
            'wilaya_id'     => is_numeric($row['wilaya_id'] ?? '') ? $row['wilaya_id'] : null,
        ]);
    }
    
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'required',
            'upw_id' => 'nullable|numeric',
            'wilaya_id' => 'nullable|numeric',
        ];
    }
}