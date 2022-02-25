<?php

namespace App\Exports;

use App\Models\Turno;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TurnoExport implements FromCollection, WithHeadings//, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        //return Turno::all();
        //return Turno::with(['sucursal', 'orden', 'orden.cliente'])->get();

        $results = DB::select(DB::raw("SELECT orden.nroOrden, orden.detalles, turno.fechaHora FROM turno INNER JOIN orden ON turno.orden_id = orden.id;"));

        return collect($results);
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'N° de Orden',
            'Detalles',
            'Fecha de Entrega'
        ];
        /*return [
            trans('admin.turno.columns.id'),
            trans('admin.turno.columns.fechaHora'),
            trans('admin.turno.columns.paraEntrega'),
            trans('admin.turno.columns.orden_id'),
            trans('admin.turno.columns.sucursal_id'),
        ];*/
    }

    /**
     * @param Turno $turno
     * @return array
     *
     */
    /*public function map($turno): array
    {
        return [
            $turno->id,
            $turno->fechaHora,
            $turno->paraEntrega,
            $turno->orden_id,
            $turno->sucursal_id,
        ];
    }*/
}
