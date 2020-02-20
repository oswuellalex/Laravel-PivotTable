<?php

namespace App\Exports;

use App\MixNetAmount;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MixNetAmountExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MixNetAmount::all();
    }

    public function headings(): array
    {
        return ["YearMonth", "year", "month", "week", "q_year", "mes_name", "bodega", "q_invoice", "monto_neto", "brand", "type", "tipo_lente", "gamma", "design", "material", "material_color", "treatment", "type_article", "Client Code", "cliente", "Tradename", "clasificac", "pais_de_env", "regionales", "City", "clasific_estrat", "Strategic Subcasing", "Grouping", "bdr"];
    }
}
