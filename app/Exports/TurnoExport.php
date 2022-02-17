<?php

namespace App\Exports;

use App\Models\Turno;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TurnoExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Turno::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.turno.columns.id'),
            trans('admin.turno.columns.fechaHora'),
            trans('admin.turno.columns.paraEntrega'),
            trans('admin.turno.columns.orden_id'),
            trans('admin.turno.columns.sucursal_id'),
        ];
    }

    /**
     * @param Turno $turno
     * @return array
     *
     */
    public function map($turno): array
    {
        return [
            $turno->id,
            $turno->fechaHora,
            $turno->paraEntrega,
            $turno->orden_id,
            $turno->sucursal_id,
        ];
    }
}
