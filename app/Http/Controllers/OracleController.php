<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OracleController extends Controller
{
    public function getDataFromOracle()
{
    $results = DB::connection('oracle')
                  ->select('SELECT * FROM NOVEDADES_SUELDO');
    
    return $results;
}

}
