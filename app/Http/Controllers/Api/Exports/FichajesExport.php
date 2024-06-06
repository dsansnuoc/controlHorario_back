<?php

namespace App\Http\Controllers\Api\Exports;

use App\Http\Controllers\Controller;
use App\Models\Fichaje;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class FichajesExport implements FromQuery, WithHeadings //  WithColumnWidths, WithStyles
{
    //

    use Exportable;


    protected $userid;
    protected $nombreConexion;
    protected $fInicial;
    protected $fFinal;

    public function __construct(string $userid, string $fInicial, string $fFinal, string $nombreConexion)
    {
        $this->userid = $userid;
        $this->nombreConexion = $nombreConexion;
        $this->fInicial = new Carbon($fInicial . ' 00:00:00');
        $this->fFinal = new Carbon($fFinal . ' 23:59:59');
    }


    public function query()
    {
        return Fichaje::on($this->nombreConexion)
            ->selectRaw('userId as Usuario')
            ->selectRaw("
            CASE 
                WHEN tipo_fichaje = 1 THEN 'Entrada'
                WHEN tipo_fichaje = 2 THEN 'Salida'
                WHEN tipo_fichaje = 11 THEN 'Parada'
                WHEN tipo_fichaje = 21 THEN 'Regreso Parada'
                ELSE ''
            END as Tipo
        ")
            ->selectRaw('hora_fichaje as Fichaje')
            ->selectRaw("
            CASE 
                WHEN tipo_fichaje = 11 THEN (
                    SELECT descripcion 
                    FROM tipo_parada 
                    WHERE tipo_parada.id = fichaje.tipo_pausa
                )
                ELSE ''
            END as TipoParada
        ")
            ->where('userid', $this->userid)
            ->whereBetween('hora_fichaje', [$this->fInicial, $this->fFinal]);
        //  ->get();
        /*
            ->where('hora_fichaje', '>=', $this->fInicial)
            ->where('hora_fichaje', '<=', $this->fFinal).get();
            */
    }


    public function headings(): array
    {
        return [
            'Usuario',
            'Fichaje',
            'Tipo',
            'TipoParada',
        ];
    }
}