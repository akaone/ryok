<?php

namespace App\Imports;

use App\Models\NerSentence;
use Maatwebsite\Excel\Concerns\ToModel;

class NerSentencesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NerSentence([
            'text' => $row['1'],
        ]);
    }
}
