<?php

namespace App\Exports;

use App\Organismo;
use App\Proyecto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class HitosExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    
    public function __construct(int $proy_id)
    {
        $this->proy_id = $proy_id;
        
    }
    
    
    public function view(): View
    {
      
       return view('EXCEL.proyectoshitos', [
         'proyectos' => Proyecto::where('proyectos.hitos', '=', $this->proy_id)
          ->select('proyectos.*')
          ->orderBy('created_at','ASC')
          ->get()
        ]); //Fin del return view
                
                 
    } //Fin public view
    
    
    
    public function title(): string
    {
        return 'Proyecto';
    }
    
  
    
    public function registerEvents(): array
{
    return [
        AfterSheet::class    => function(AfterSheet $event) {
            // All headers - Set font to 14
            $event->sheet->getDelegate()->getStyle('A1:F1')->getFont()
            ->setBold(true)->setSize(12);
            
                  
            $event->sheet->getDelegate()->getStyle('A1:F1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('9DF2EC');
                     
       
            // Set the first line height to 20
            $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

            // Set up automatic line breaking for text in A1:D4 range
            $event->sheet->getDelegate()->getStyle('B1:B1000')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            $event->sheet->getDelegate()->getStyle('F1:F1000')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            $event->sheet->getDelegate()->getStyle('A1:F1000')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            
            $event->sheet->getDelegate()->getStyle('A2')->getFont()->setSize(11);
            
            

        },
    ];
} // Fin styles
    
 } //Fin de la clase
