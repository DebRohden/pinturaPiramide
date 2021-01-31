<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\geralController;

Route::get('/calculo/{h}/{ab}/{tinta}',  [geralController::class, 'getDadosEntrada']);


// O usu ́ario informar ́a os valores de h(primeira
// figura) e ab(primeira figura), como tamb ́em o tipo de tinta a ser utilizado:
// Tipo 1 – R$ 127,90 Tipo 2 – R$ 258,98 Tipo 3 – R$ 344,34
