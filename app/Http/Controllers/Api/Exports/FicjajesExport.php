<?php

namespace App\Http\Controllers\Api\Exports;

use App\Http\Controllers\Controller;
use App\Models\Fichaje;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;

class FicjajesExport implements FromQuery // , WithColumnWidths, WithStyles
{
    //

    use Exportable;


    protected $userid;
    protected $nombreConexion;

    public function __construct(string $userid, string $nombreConexion)
    {
        $this->userid = $userid;
        $this->nombreConexion = $nombreConexion;
    }


    public function query()
    {
        return Fichaje::on($this->nombreConexion)->where('userid', $this->userid);
    }
}
