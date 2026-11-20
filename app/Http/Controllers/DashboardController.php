<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Transaccion;

class DashboardController extends Controller
{
    public function index()
    {
        // Saldo total de todas las cuentas
        $saldoTotal = Cuenta::sum('saldo');

        // Ingresos del mes actual
        $ingresosMes = Transaccion::where('tipo', 'ingreso')
            ->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->sum('monto');

        // Gastos del mes actual
        $gastosMes = Transaccion::where('tipo', 'gasto')
            ->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->sum('monto');

        // Cuentas registradas
        $cuentas = Cuenta::orderBy('nombre')->get();

        // Últimas cinco transacciones
        $ultimasTransacciones = Transaccion::with(['cuenta', 'categoria'])
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'saldoTotal',
            'ingresosMes',
            'gastosMes',
            'cuentas',
            'ultimasTransacciones'
        ));
    }
}
