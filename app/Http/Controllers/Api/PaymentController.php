<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function saveSaleNote(Request $request)
    {
        $user = Auth::user();
        $status = PaymentService::saveSaleNote($request->nroTransaction, $request->pictureId, $user->id);
        return $status;
    }

    public function generate()
    {
        return PaymentService::generateQr();
    }


    public function consultarEstado(int $nroTransaccion = 1149472)
    {
        return PaymentService::checkTransaction($nroTransaccion);
    }

    public function checkTransactions()
    {
        $user = Auth::user();
        return PaymentService::updatePendingTransactions($user->id);
    }

    public function urlCallback(Request $request)
    {
        $Venta = $request->input("PedidoID");
        $Fecha = $request->input("Fecha");
        $NuevaFecha = date("Y-m-d", strtotime($Fecha));
        $Hora = $request->input("Hora");
        $MetodoPago = $request->input("MetodoPago");
        $Estado = $request->input("Estado");
        $Ingreso = true;

        try {
            $arreglo = ['error' => 0, 'status' => 1, 'message' => "Pago realizado correctamente.", 'values' => true];
        } catch (\Throwable $th) {
            $arreglo = ['error' => 1, 'status' => 1, 'messageSistema' => "[TRY/CATCH] " . $th->getMessage(), 'message' => "No se pudo realizar el pago, por favor intente de nuevo.", 'values' => false];
        }

        return response()->json($arreglo);
    }
}
