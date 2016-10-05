<?php

Route::get('/confessions', 'APIController@getConfessions')->middleware('api');
Route::post('/confessions', 'APIController@postConfession')->middleware('api');
Route::delete('/confessions', 'APIController@deleteConfession')->middleware('api');
Route::patch('/confessions', 'APIController@updateConfession')->middleware('api');



