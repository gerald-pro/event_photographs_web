<?php

namespace App\Services;

use App\Models\SaleNote;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class PaymentService
{
    public static function saveSaleNote(int  $nroTransaction, int $pictureId, int $userId)
    {
        $status = 'success';
        $message = 'Nota de venta registrada correctamente';
        try {
            SaleNote::create([
                'nro_transaction' => $nroTransaction,
                'user_id' => $userId,
                'picture_id' => $pictureId,
            ]);
        } catch (\Throwable $th) {
            $status = 'error';
            $message = $th->getMessage();
        }

        return ['status' => $status, 'message' => $message];
    }

    public static function generateQr()
    {
        try {
            $nQr = 1;
            if (Cache::has('qrs')) {
                Cache::increment('qrs');
                $nQr = Cache::get('qrs') + 10;
            } else {
                Cache::put('qrs', 1);
            }

            $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda              = 2;
            $lnTelefono            = 70480741;
            $lcNombreUsuario       = 'Gerald Avalos';
            $lnCiNit               = 14495734;
            $lcNroPago             = 'grupo03-' . $nQr;
            $lnMontoClienteEmpresa = 0.02;
            $lcCorreo              = 'geraldjoseavalosseveriche@gmail.com';
            $lcUrlCallBack         = "http://localhost:8000/";
            $lcUrlReturn           = "http://localhost:8000/";
            $laPedidoDetalle       = [[
                "Serial" => "1",
                "Producto" => "Fotografia",
                "Cantidad" => "0.02",
                "Precio" => "0.02",
                "Descuento" => "0",
                "Total" => "0.02"
            ]];

            

            $lcUrl                 = "";
            $loClient = new Client();
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";

            $laHeader = [
                'Accept' => 'application/json'
            ];

            $laBody   = [
                "tcCommerceID"          => $lcComerceID,
                "tnMoneda"              => $lnMoneda,
                "tnTelefono"            => $lnTelefono,
                'tcNombreUsuario'       => $lcNombreUsuario,
                'tnCiNit'               => $lnCiNit,
                'tcNroPago'             => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo"              => $lcCorreo,
                'tcUrlCallBack'         => $lcUrlCallBack,
                "tcUrlReturn"           => $lcUrlReturn,
                'taPedidoDetalle'       => $laPedidoDetalle
            ];

            dump($laBody );

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $laResult = json_decode($loResponse->getBody()->getContents());
            dump($laResult);
            $laValues = explode(";", $laResult->values)[1];
            $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
            if ($laResult->error == 0) {
                $laValues = explode(";", $laResult->values);
                $qrImage = json_decode($laValues[1])->qrImage;
                $response = [
                    'nroTransaction' => $laValues[0] ?? '',
                    'error' => $laResult->error ?? 1,
                    'message' => $laResult->message ?? '',
                    'messageSistema' => $laResult->messageSistema ?? '',
                    'qrImage' => $qrImage
                ];
            } else {
                $response = [
                    'error' => $laResult->error,
                    'message' => $laResult->messageSistema ?? '',
                ];
            }
            //dump('--------------------------------------');
            dd($response);
            return  response()->json($response);
        } catch (\Throwable $th) {
            return ['error' => 1, 'message' => $th->getMessage() . " - " . $th->getLine()];
        }
    }

    public static function checkTransaction(int $lnTransaccion)
    {
        $status = 'error';

        try {
            $loClientEstado = new Client();
            $lcUrlEstadoTransaccion = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/consultartransaccion";

            $loEstadoTransaccion = $loClientEstado->post($lcUrlEstadoTransaccion, [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'json' => ["TransaccionDePago" => $lnTransaccion]
            ]);

            $laResultEstadoTransaccion = json_decode($loEstadoTransaccion->getBody()->getContents());
            if ($laResultEstadoTransaccion->error == 0) {
                $result = strtolower($laResultEstadoTransaccion->values->messageEstado);
                if (strpos($result, 'procesado')) {
                    $status = 'procesado';
                } else {
                    $status = 'en cola';
                }
            } else {
                $status = 'error';
            }
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            return ['status' => $status, 'message' => $message];
        }
        return ['status' => $status, 'message' => $laResultEstadoTransaccion->message];
    }

    public static function updatePendingTransactions(int $userId)
    {
        $status = 'succes';
        try {
            $saleNotes = SaleNote::all()->where('user_id', '=', $userId)->where('status', '=', 0);
            $updates = 0;
            $deletes = 0;
            foreach ($saleNotes as $saleNote) {
                $expirationDate = Carbon::parse($saleNote->created_at);
                $dateDiff = Carbon::now()->diffInMinutes($expirationDate);

                if ($dateDiff > 60) {
                    $saleNote->delete();
                    $deletes++;
                } else {
                    $response = self::checkTransaction($saleNote->nro_transaction);
                    if ($response['status'] == 'procesado') {
                        $saleNote->update(['status' => 1]);
                        $updates++;
                    }
                }
            }
            $message = 'actualizacion realizada correctamente. '
                . $updates . ' actualizaciones. '
                . $deletes . ' eiminados';
        } catch (\Throwable $th) {
            $status = 'error';
            $message = $th->getMessage();
        }
        return ['status' => $status, 'message' => $message];
    }
}
