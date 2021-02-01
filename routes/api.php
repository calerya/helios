<?php

use Illuminate\Http\Request;

Route::get('/proyecto/{id}/organismo', 'Proyecto\ProyectoController@getOrganismo');

Route::get('/organismo/{id}/proyecto', 'Organismo\OrganismoController@getProyecto');


    
 