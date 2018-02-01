<?php

Route::group(['prefix' => 'pdrb-harga-dasar', 'middleware' => ['web']], function() {

    $controllers = (object) [
        'index'     => 'Bantenprov\PdrbHargaDasar\Http\Controllers\PdrbHargaDasarController@index',
        'create'     => 'Bantenprov\PdrbHargaDasar\Http\Controllers\PdrbHargaDasarController@create',
        'store'     => 'Bantenprov\PdrbHargaDasar\Http\Controllers\PdrbHargaDasarController@store',
        'show'      => 'Bantenprov\PdrbHargaDasar\Http\Controllers\PdrbHargaDasarController@show',
        'update'    => 'Bantenprov\PdrbHargaDasar\Http\Controllers\PdrbHargaDasarController@update',
        'destroy'   => 'Bantenprov\PdrbHargaDasar\Http\Controllers\PdrbHargaDasarController@destroy',
    ];

    Route::get('/',$controllers->index)->name('pdrb-harga-dasar.index');
    Route::get('/create',$controllers->create)->name('pdrb-harga-dasar.create');
    Route::post('/store',$controllers->store)->name('pdrb-harga-dasar.store');
    Route::get('/{id}',$controllers->show)->name('pdrb-harga-dasar.show');
    Route::put('/{id}/update',$controllers->update)->name('pdrb-harga-dasar.update');
    Route::post('/{id}/delete',$controllers->destroy)->name('pdrb-harga-dasar.destroy');

});

