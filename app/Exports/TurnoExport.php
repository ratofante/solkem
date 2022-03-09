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
        // fechaIngreso, n° Orden, , Detalle, ultimoEstado

        $results = DB::select(DB::raw("SELECT orden.created_at, orden.nroOrden, orden.detalles, estado.estado, turno.fechaHora FROM turno INNER JOIN orden ON turno.orden_id = orden.id INNER JOIN estado_orden ON orden.id = estado_orden.orden_id INNER JOIN estado ON estado_orden.estado_id = estado.id WHERE estado_orden.actual = 1;"));

        return collect($results);
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Fecha de Ingreso',
            'N° de Orden',
            'Detalles',
            'Estado Actual',
            'Fecha de Entrega'
        ];
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
