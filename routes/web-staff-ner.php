<?php


use App\Http\Livewire\StaffNerImportData;
use App\Http\Livewire\StaffNerIndex;

Route::prefix("staff/named-entity-recognition")->name('staff.ner.')->group(function () {

    Route::get("/", StaffNerIndex::class)->name('index');

    Route::get("/import-data", StaffNerImportData::class)->name('import-data');

});
