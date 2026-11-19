<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::all();

        return view('cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        return view('cuentas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable|max:255',
            'saldo' => 'required|numeric|min:0',
            'moneda' => 'required|max:10',
        ]);

        Cuenta::create($request->all());

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta creada exitosamente.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Cuenta $cuenta)
    {
        return view('cuentas.edit', compact('cuenta'));
    }

    public function update(Request $request, Cuenta $cuenta)
    {
        $request->validate([
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable|max:255',
            'saldo' => 'required|numeric|min:0',
            'moneda' => 'required|max:10',
        ]);

        $cuenta->update($request->all());

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta actualizada exitosamente.');
    }

    public function destroy(Cuenta $cuenta)
    {
        if ($cuenta->transacciones()->count() > 0) {
            return redirect()->route('cuentas.index')
                ->with('error', 'No se puede eliminar: la cuenta tiene transacciones asociadas.');
        }

        $cuenta->delete();

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta eliminada exitosamente.');
    }
}