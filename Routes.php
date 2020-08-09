<?php

Route::set('create', 'CreateController::Show', 'GET');
Route::set('create', 'CreateController::Create', 'POST');

Route::set('edit', 'EditController::Show', 'GET');
Route::set('edit', 'EditController::Edit', 'POST');

Route::set('home', 'HomeController::Show', 'GET');
Route::set('delete', 'HomeController::Delete', 'POST');

?>