<?php

namespace App\Http\Livewire\StaffNer;

use App\Models\NerSentence;
use Livewire\Component;

class StaffNerIndex extends Component
{

    public function generateJsonl()
    {
        $sentences = NerSentence::leftJoin(
            'ner_entities as ne', 'ne.ner_sentences_id', "=", 'ner_sentences.id')
            ->where('ne.id', "!=",null)
            ->select('ner_sentences.id', 'ner_sentences.text', 'ne.start', 'ne.end', 'ne.label')
            ->get();

        $jsonlArr = [];
        $grouped = $sentences->groupBy(function ($item, $key) {
            return $item->text;
        });
        foreach ($grouped as $key => $value) {
            $temp = [
                "text_snippet" => [
                    "content" => $key
                ],
                "annotations" => [],
            ];
            foreach ($value as $item => $entity) {
                $temp["annotations"] [] = [
                    "text_extraction" => [
                        "text_segment" => [
                            "end_offset" => $entity->end,
                            "start_offset" => $entity->start,
                        ],
                    ],
                    "display_name" => $entity->label
                ];
            }
            $jsonlArr [] = $temp;
        }
        dd(json_encode($jsonlArr));
    }

    public function render()
    {
        return view('staff-ner.staff-ner-index')
            ->extends('layouts.dash')
            ->section('body');
    }
}
