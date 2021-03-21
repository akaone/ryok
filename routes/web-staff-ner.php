<?php


use App\Http\Livewire\StaffNer\StaffNerImportData;
use App\Http\Livewire\StaffNer\StaffNerIndex;

Route::prefix("staff/named-entity-recognition")->name('staff.ner.')->group(function () {

    Route::get("/", StaffNerIndex::class)->name('index');

    Route::get("/import-data", StaffNerImportData::class)->name('import-data');

});
