<?php

namespace App\Http\Controllers\Api\Exports;

use App\Models\Roles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/*
class RolesExport implements FromCollection
{
    //
    public function collection()
    {
        return Roles::all();
    }
}
*/

class RolesExport implements FromQuery, WithColumnWidths, WithStyles
{

    use Exportable;

    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 55,
            'B' => 45,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function query()
    {
        return Roles::query()->where('id', $this->id);
    }
}
