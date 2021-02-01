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





class OrganismosExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
    
{
       
    public function __construct(string $seleccionado)
    {
        $this->seleccionado = $seleccionado;
        
    }
    
    
    public function view(): View
    {
      
        switch ($this->seleccionado) {
                 
        case "Todos":
        
            return view('EXCEL.organismos', [
               'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as municipio', 'proyectos.sociedad as sociedad','organismos.*')
                ->where('organismos.finalizado','=', '0')
                ->orderBy('proyectos.id','ASC')
                ->get()
            ]);
                
        break;
                
        case "Finalizados":
                
            return view('EXCEL.organismos', [
                'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as municipio', 'proyectos.sociedad as sociedad','organismos.*')
                ->where('organismos.finalizado','=', '1')
                ->orderBy('fec_presentacion','ASC')
                ->get()
                ]);
                
        break;
                
        case "Caducados":
                
            $fechamas30=today()->addDays(30);                
            return view('EXCEL.organismos', [
            'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
            ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as municipio', 'proyectos.sociedad as sociedad','organismos.*')
            ->where('fec_caducidad','<',$fechamas30)
            ->where('organismos.finalizado','=', '0')
            ->orderBy('fec_caducidad','ASC')
            ->get()
             ]);   
                
        break;
                
         case "Requerimiento":
                
                return view('EXCEL.organismos', [
                'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as municipio', 'proyectos.sociedad as sociedad','organismos.*')
                ->whereNotNull('fec_requerimiento')
                ->whereNull('fec_cont_requerimiento')
                ->where('organismos.finalizado','=', '0')
                ->orderBy('fec_caducidad','ASC')
                ->get()
                ]); 
                
                break;
                
        case "Prorroga":
                
                return view('EXCEL.organismos', [
                'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as municipio', 'proyectos.sociedad as sociedad','organismos.*')
                ->whereNotNull('fec_solic_prorroga')
                ->whereNull('fec_concesion_pror')
                ->where('organismos.finalizado','=', '0')
                ->orderBy('fec_solic_prorroga','ASC')
                ->get()
                ]);
                
                break;
                
        case "APM":
                
                return view('EXCEL.organismos', [
                'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as municipio', 'proyectos.sociedad as sociedad','organismos.*')
                ->whereNotNull('fec_solic_apm')
                ->whereNull('fec_conc_apm')
                ->where('organismos.finalizado','=', '0')
                ->orderBy('fec_solic_apm','ASC')
                ->get()
                ]);
                
                break;
                
        case "Con-resolucion":
                
                return view('EXCEL.organismos', [
                'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as municipio', 'proyectos.sociedad as sociedad', 'organismos.*')
                ->whereNotNull('fec_resolucion')
                ->where('organismos.finalizado','=', '0')
                ->orderBy('fec_resolucion','ASC')
                ->get()
                ]);
                
                break;
                
        case "Sin-resolucion":
                
                return view('EXCEL.organismos', [
                'organismos' => Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal','proyectos.sociedad as sociedad', 'organismos.*')
                ->whereNull('fec_resolucion')
                ->where('organismos.finalizado','=', '0')
                ->orderBy('fec_presentacion','ASC')
                ->get()
                ]);
                
                break;
                
                
                
        } //Fin switch
                
    } //Fin public view
    
    
    
    public function title(): string
    {
        return 'Organismos';
    }
    
  
    
    public function registerEvents(): array
{
    return [
        AfterSheet::class    => function(AfterSheet $event) {
            // All headers - Set font to 14
            $event->sheet->getDelegate()->getStyle('A1:U1')->getFont()
            ->setBold(true)->setSize(12);
            
            $event->sheet->getDelegate()->getStyle('I1:T1')->getFont()
            ->setSize(11);
            
            $event->sheet->getDelegate()->getStyle('A1:U1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('9DF2EC');
            
            $event->sheet->getStyle('U2:U1000')->getAlignment()->setWrapText(true);
            
           
            
            $event->sheet->getColumnDimension('I')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(14);
            $event->sheet->getColumnDimension('J')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(14);
            $event->sheet->getColumnDimension('K')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(14);
            $event->sheet->getColumnDimension('L')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(14);
            $event->sheet->getColumnDimension('M')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(14);
            $event->sheet->getColumnDimension('N')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(14);
            $event->sheet->getColumnDimension('O')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(14);
            $event->sheet->getColumnDimension('P')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('P')->setWidth(14);
            $event->sheet->getColumnDimension('Q')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('Q')->setWidth(14);
            $event->sheet->getColumnDimension('R')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('R')->setWidth(14);
            $event->sheet->getColumnDimension('S')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('S')->setWidth(14);
            $event->sheet->getColumnDimension('T')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('T')->setWidth(14);
            $event->sheet->getColumnDimension('U')->setAutoSize(false);
            $event->sheet->getDelegate()->getColumnDimension('U')->setWidth(80);
          

            // Set the first line height to 20
            $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

            // Set up automatic line breaking for text in A1:D4 range
            $event->sheet->getDelegate()->getStyle('F1:T1000')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            $event->sheet->getDelegate()->getStyle('A1:U1000')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            
            $event->sheet->getDelegate()->getStyle('A2')->getFont()->setSize(11);
            
            

        },
    ];
} // Fin styles
    
 } //Fin de la clase



    
    
 