<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\novedades_sueldos;



class FileController extends Controller
{
    public function store(Request $request)
    {
    $file = $request->file('file');
    $content = file_get_contents($file->getRealPath());
    
    $contentLines = explode("\n", $content);
    $validLines = [];
    
    foreach ($contentLines as $line) {
        $line = trim($line);
        if (mb_strlen($line) !== 80) {
            return response()->json([
                "success" => false,
                "message" => "La línea '".$line."' tiene una longitud incorrecta. Debe contener exactamente 80 caracteres."
            ]);
        } else {
            $var1 = substr($line, 0, 2); 
            $var2 = substr($line, 8, 7);
            $var3 = substr($line, 15, 3);
            $var4 = str_replace(' ', '0', substr($line, 18, 7));
            $var5 = substr($line, 27, 3);
            $var6 = str_replace(' ', '0', substr($line, 30, 7));
            $var7 = substr($line, 39, 3);
            $var8 = str_replace(' ', '0', substr($line, 42, 7));
            $var9 = substr($line, 51, 3);
            $var10 = str_replace(' ', '0', substr($line, 54, 7));
            $var11 = substr($line, 63, 3);
            $var12 = str_replace(' ', '0', substr($line, 66, 7));
            $var13 = substr($line, 78, 2);

            if (!is_numeric($var1)) {
                return response()->json([
                    "success" => false,
                    "message" => "El valor de $var1 debe ser numérico"
                ]);
            }
            if (!is_numeric($var2)) {
                return response()->json([
                    "success" => false,
                    "message" => "El valor de $var2 debe ser numérico"
                ]);
            }
            if (!is_numeric($var4)) {
                return response()->json([
                    "success" => false,
                    "message" => "El valor de $var4 debe ser numérico"
                ]);
            }
            if (!is_numeric($var6)) {
                return response()->json([
                    "success" => false,
                    "message" => "El valor de $var6 debe ser numérico"
                ]);
            }
            if (!is_numeric($var8)) {
                return response()->json([
                    "success" => false,
                    "message" => "El valor de $var8 debe ser numérico"
                ]);
            }
            if (!is_numeric($var10)) {
                return response()->json([
                    "success" => false,
                    "message" => "El valor de $var10 debe ser numérico"
                ]);
            }
            if (!is_numeric($var12)) {
                return response()->json([
                    "success" => false,
                    "message" => "El valor de $var12 debe ser numérico"
                ]);
            }
            
            $validLines[] = [
                'var1' => $var1,
                'var2' => $var2,
                'var3' => $var3,
                'var4' => $var4,
                'var5' => $var5,
                'var6' => $var6,
                'var7' => $var7,
                'var8' => $var8,
                'var9' => $var9,
                'var10' => $var10,
                'var11' => $var11,
                'var12' => $var12,
                'var13' => $var13,
            ];
        }
    }        
     
    foreach ($validLines as $lineData) {
        $novedades_sueldos = new novedades_sueldos;
        $novedades_sueldos->centro = $lineData['var1'];
        $novedades_sueldos->padron = $lineData['var2'];
        $novedades_sueldos->codigo1 = $lineData['var3'];
        $novedades_sueldos->importe1 = $lineData['var4'];
        $novedades_sueldos->codigo2 = $lineData['var5'];
        $novedades_sueldos->importe2 = $lineData['var6'];
        $novedades_sueldos->codigo3 = $lineData['var7'];
        $novedades_sueldos->importe3 = $lineData['var8'];
        $novedades_sueldos->codigo4 = $lineData['var9'];
        $novedades_sueldos->importe4 = $lineData['var10'];
        $novedades_sueldos->codigo5 = $lineData['var11'];
        $novedades_sueldos->importe5 = $lineData['var12'];
        $novedades_sueldos->tipo_novedad = $lineData['var13'];
        $novedades_sueldos->save();
    }
    
    
    $imageName = time().'.'.$file->extension();
    $imagePath = public_path('archivos'). '/files';
    
    $file->move($imagePath, $imageName);
    
    return response()->json([
        "success" => true,
        "message" => "Archivo subido correctamente.",
        //"registros" => $novedades_sueldos
    ]);
 
    }
}
