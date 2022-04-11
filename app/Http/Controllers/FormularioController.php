<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FormularioController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $registros = Formulario::selectRaw('
                                COUNT(*) AS total,
                                dia
                            ')
                            ->groupBy('dia')
                            ->get();

        // Para mostrar el formulario
        $visualizar = true;

        if($registros->count() > 1){
            $visualizar = $registros->some(function($item, $key){
                return $item->total < 8;
            });
        }

        // Verificar disponibilidad de cada día
        $evaluarDia = $registros->map(function($item, $key){
            if($item->total < 8){
                $item->mostrar = true;
            } else {
                $item->mostrar = false;
            }

            return $item;
        });

        return view('formularios.index', compact('visualizar', 'evaluarDia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        // No hacer nada si no está disponible
        if(!self::checkAvailability()){
            abort(404);
        }

        // Validations
        $request->validate([
            'familia' => 'required|string|min:5',
            'personas' => 'required|integer|min:1|max:100',
            'dia' => 'required|string|in:sábado,domingo',
            'telefono' => 'required|digits:10'
        ]);

        // Verify if no exists the same data
        $exist = Formulario::where('familia', $request->familia)
                            ->where('personas', $request->personas)
                            ->where('dia', $request->dia)
                            ->where('telefono', $request->telefono)
                            ->first();

        if($exist){
            // Create a flash message
            session()->flash('type', 'warning');
            session()->flash('message', '¡Te comentamos que tu información ya está registrada!');
            return back();
        }

        // Store a record
        Formulario::create([
            'familia' => Str::title(trim($request->familia)),
            'personas' => $request->personas,
            'dia' => Str::ucFirst($request->dia),
            'telefono' => $request->telefono
        ]);

        // Create a flash message
        session()->flash('type', 'success');
        session()->flash('message', '¡Tu registro fue almacenado exitosamente!');

        return redirect()->route('formulario.index');
    }

    public static function checkAvailability(){
        if(date('w') < 4){
            return true;
        } else if(date('w') == 4 && date('H:i') <= '18:00' ) {
            return true;
        } else {
            return false;
        }
    }
}
