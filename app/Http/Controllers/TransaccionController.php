<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Cuenta;
use App\Models\Categoria;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::all();

        return view('transacciones.index', compact('transacciones'));
    }

    public function create()
    {
        $cuentas = Cuenta::all();
        $categorias = Categoria::all();

        return view('transacciones.create', compact('cuentas', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo' => 'required|in:ingreso,gasto',
            'monto' => 'required|numeric|gt:0',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|max:255',
        ]);

        $cuenta = Cuenta::find($request->cuenta_id);
        $categoria = Categoria::find($request->categoria_id);

        // Validar que el tipo de categoría coincida
        if ($categoria->tipo != $request->tipo) {
            return back()->withErrors([
                'categoria_id' => 'La categoría no corresponde al tipo de transacción.'
            ])->withInput();
        }

        // Validar que haya saldo suficiente
        if ($request->tipo == 'gasto' && $request->monto > $cuenta->saldo) {
            return back()->withErrors([
                'monto' => 'El gasto supera el saldo disponible de la cuenta.'
            ])->withInput();
        }

        // Actualizar el saldo
        if ($request->tipo == 'ingreso') {
            $cuenta->saldo = $cuenta->saldo + $request->monto;
        } else {
            $cuenta->saldo = $cuenta->saldo - $request->monto;
        }

        $cuenta->save();

        // Registrar la transacción
        Transaccion::create([
            'cuenta_id' => $request->cuenta_id,
            'categoria_id' => $request->categoria_id,
            'tipo' => $request->tipo,
            'monto' => $request->monto,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'creado_por' => auth()->user()->name,
        ]);

        return redirect()->route('transacciones.index')
            ->with('success', 'Transacción creada exitosamente.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Transaccion $transaccion)
    {
        $cuentas = Cuenta::all();
        $categorias = Categoria::all();

        return view('transacciones.edit',
            compact('transaccion', 'cuentas', 'categorias'));
    }

    public function update(Request $request, Transaccion $transaccion)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo' => 'required|in:ingreso,gasto',
            'monto' => 'required|numeric|gt:0',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|max:255',
        ]);

        $categoria = Categoria::find($request->categoria_id);

        if ($categoria->tipo != $request->tipo) {
            return back()->withErrors([
                'categoria_id' => 'La categoría no corresponde al tipo de transacción.'
            ])->withInput();
        }

        $cuentaAnterior = Cuenta::find($transaccion->cuenta_id);
        $cuentaNueva = Cuenta::find($request->cuenta_id);

        // Revertir el efecto de la transacción anterior
        $saldoRestaurado = $cuentaAnterior->saldo;

        if ($transaccion->tipo == 'ingreso') {
            $saldoRestaurado = $saldoRestaurado - $transaccion->monto;
        } else {
            $saldoRestaurado = $saldoRestaurado + $transaccion->monto;
        }

        // Si es la misma cuenta, usar el saldo restaurado
        if ($cuentaAnterior->id == $cuentaNueva->id) {
            $saldoDisponible = $saldoRestaurado;
        } else {
            $saldoDisponible = $cuentaNueva->saldo;
        }

        // Comprobar el nuevo gasto antes de modificar los saldos
        if ($request->tipo == 'gasto' && $request->monto > $saldoDisponible) {
            return back()->withErrors([
                'monto' => 'El gasto supera el saldo disponible de la cuenta.'
            ])->withInput();
        }

        // Guardar el saldo restaurado en la cuenta anterior
        $cuentaAnterior->saldo = $saldoRestaurado;
        $cuentaAnterior->save();

        // Aplicar el nuevo movimiento a la cuenta seleccionada
        if ($request->tipo == 'ingreso') {
            $cuentaNueva->saldo = $saldoDisponible + $request->monto;
        } else {
            $cuentaNueva->saldo = $saldoDisponible - $request->monto;
        }

        $cuentaNueva->save();

        // Actualizar la transacción
        $transaccion->update([
            'cuenta_id' => $request->cuenta_id,
            'categoria_id' => $request->categoria_id,
            'tipo' => $request->tipo,
            'monto' => $request->monto,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('transacciones.index')
            ->with('success', 'Transacción actualizada exitosamente.');
    }

    public function destroy(Transaccion $transaccion)
    {
        $cuenta = Cuenta::find($transaccion->cuenta_id);

        // Revertir el efecto de la transacción
        if ($transaccion->tipo == 'ingreso') {
            $cuenta->saldo = $cuenta->saldo - $transaccion->monto;
        } else {
            $cuenta->saldo = $cuenta->saldo + $transaccion->monto;
        }

        $cuenta->save();

        $transaccion->delete();

        return redirect()->route('transacciones.index')
            ->with('success', 'Transacción eliminada exitosamente.');
    }
}
