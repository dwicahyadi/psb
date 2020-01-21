<?php

namespace App\Imports;

use App\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Question([
            'subjects'=> $row['pelajaran'],
            'question'=> $row['pertanyaan'],
            'option_a'=> $row['a'],
            'option_b'=> $row['b'],
            'option_c'=> $row['c'],
            'option_d'=> $row['d'],
            'answer'=> $row['jawaban'],
            'score'=> $row['score'],
        ]);
    }
}
