<?php

namespace App\Http\Livewire;

use App\Imports\NerSentencesImport;
use App\Models\NerEntity;
use App\Models\NerSentence;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class StaffNerImportData extends Component
{
    use WithFileUploads;

    public $excelFile;
    protected $currentSentencePaginate;
    protected $currentSentence;
    public $nextUrl;
    public $sentenceId;

    public function toNext($entities)
    {
        # todo: Refactor this to repository
        $tabs = new Collection();
        foreach ($entities as $entity) {
            $obj = (object) $entity;
            $obj->ner_sentences_id = $this->sentenceId;
            $tabs->push((array) $obj);
        }
        NerEntity::upsert(
            $tabs->toArray(),
            ['ner_sentences_id', 'start', 'end', 'label'],
            ['start', 'end', 'label', 'text'],
        );
        return redirect()->to($this->nextUrl);
    }


    public function updatedExcelFile($value)
    {
        Excel::import(new NerSentencesImport, $value);
        $this->notLabeledSentences();
    }

    public function notLabeledSentences()
    {
        $this->currentSentencePaginate = NerSentence::leftJoin(
            'ner_entities as ne', 'ne.ner_sentences_id', "=", 'ner_sentences.id')
            ->where('ne.id', "=",null)
            ->select('ner_sentences.*', 'ne.label')
            ->paginate(1);

        $this->currentSentence = $this->currentSentencePaginate->first();
        $this->sentenceId = $this->currentSentence->id;
        $this->nextUrl = $this->currentSentencePaginate->nextPageUrl();
    }


    public function render()
    {
        $this->notLabeledSentences();

        return view('livewire.staff-ner-import-data', [
            'currentSentence' => $this->currentSentence,
            'currentSentencePaginate' => $this->currentSentencePaginate,
        ])
        ->extends('layouts.no-modal')
        ->section('body');
    }
}
