<?php

namespace App\Exports;

use App\Models\MachineModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\MachineMov;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;

class MachineMovExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, ShouldAutoSize, WithEvents, WithProperties, WithTitle
{
    use Exportable;
    protected $idMachine, $dateStart, $dateEnd;

    public function __construct(int $idMachine = null, string $dateStart = null, string $dateEnd = null)
    {

        $this->idMachine = $idMachine;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }
    public function collection()
    {
        $idMachine = $this->idMachine;

        $machineMovs  = MachineMov::query();

        $machineMovs->whereHas('Machine', function ($query) use ($idMachine) {

            $query->whereHas('Tankmachines', function ($query1) use ($idMachine) {

                $query1->whereBetween('tanq_fecha', [$this->dateStart, $this->dateEnd]);
                $query1->where('tanq_estado', 'A');
            });
        });
        $machineMovs->where('mqmv_estado', 'A');
        if ($idMachine) {
            $machineMovs->where('mqmv_idmaquina',  $idMachine);
        }

        $machineMovs->whereBetween('mqmv_fecha', [$this->dateStart, $this->dateEnd]);

        $collection = [];
        $collectionTank = [];
        $collectionMachinePayment = [];
        $volum = 0;
        $total_tank = 0;
        $valor_payment = 0;
        $obs = '';
        foreach ($machineMovs->get() as $key => $value) {

            $hour = (int) $value->mqmv_hfin - (int) $value->mqmv_hinicio;
            $mqmv_fecha = $value->mqmv_fecha;
            // dump($mqmv_fecha);

            foreach ($value->Machine->MachinePayments as $payment) {
                $mqdt_fecha = $payment->mqpg_fecha;

                if ($mqdt_fecha  == $mqmv_fecha) {
           
                    if(isset($collectionMachinePayment[$mqmv_fecha])){
                        $valor_payment  =$payment->mqpg_vlrpagado+$collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'];
                        // dump($valor_payment);
                        $obs =  $payment->mqpg_obs .', '. $collectionMachinePayment[$mqmv_fecha]['mqpg_obs'] ;
                        $collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'] = $valor_payment;

                    }else{
                        $obs =$payment->mqpg_obs;
                        $valor_payment = $payment->mqpg_vlrpagado;
                    }

                    $collectionMachinePayment[$mqmv_fecha]['mqpg_obs'] = $obs;
                    $collectionMachinePayment[$mqmv_fecha]['mqpg_concepto'] = $payment->ConceptPayment->cncp_nombre;
                    $collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'] = $valor_payment;

              
             
                }
            }


            foreach ($value->Machine->Tankmachines as $tank) {

                $tanq_fecha = $tank->tanq_fecha;

                if ($tanq_fecha  == $mqmv_fecha) {
                    if(isset($collectionTank[$mqmv_fecha])){
                        // $valor_payment  =$payment->mqpg_vlrpagado+$collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'];
                        $volum = $tank->tanq_volumen +  $collectionTank[$mqmv_fecha]['tanq_volumen'] ;
                       
                        $total_tank = $tank->tanq_volumen * $tank->Fuelsshopping->ccmb_vlrunidad + $collectionTank[$mqmv_fecha]['total_del_tanqueo'];
                    }else{
                        $volum = $tank->tanq_volumen;
                        $total_tank = $tank->tanq_volumen * $tank->Fuelsshopping->ccmb_vlrunidad;
                    }
   
                    $collectionTank[$mqmv_fecha]['id'] = $tank->id;
                    $collectionTank[$mqmv_fecha]['tanq_fecha'] = $tank->tanq_fecha;
                    $collectionTank[$mqmv_fecha]['tanq_volumen'] = $volum;
                    $collectionTank[$mqmv_fecha]['valor_tanqueo'] = $tank->Fuelsshopping->ccmb_vlrunidad;
                    $collectionTank[$mqmv_fecha]['total_del_tanqueo'] = $total_tank;
                }
            }

            array_push($collection, [

                "mqmv_fecha" => $value->mqmv_fecha,
                "mqmv_idmaquina" => $value->Machine->maqn_placa,
                "mqmv_hinicio" => $value->mqmv_hinicio,
                "mqmv_hfin" => $value->mqmv_hfin,
                'acpm' =>  $collectionTank[$mqmv_fecha]['tanq_volumen'] ?? 0,
                'valor_galon' => $collectionTank[$mqmv_fecha]['valor_tanqueo'] ?? 0,
                'consumo_acpm' => $collectionTank[$mqmv_fecha]['total_del_tanqueo'] ?? 0,
                "horas" => $hour,
                "mqmv_vlrhora" => $value->mqmv_vlrhora,
                "total_dia" =>  $hour * $value->mqmv_vlrhora,
                'observación' => $collectionMachinePayment[$mqmv_fecha]['mqpg_obs'] ?? '',
                'gastos' =>  $collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'] ?? ''

            ]);
        }
        // dump($collectionMachinePayment);
        // dd($collection);
        return collect([
            $collection
        ]);
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Maquina placa',
            'Hora inicial',
            'Hora final',
            'ACMP',
            'Valor galón',
            'Acpm',
            'Horas',
            'Valor hora',
            'Total dia',
            'Observación',
            'Gastos',
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 25,
            'C' => 12,
            'D' => 12,
            'E' => 12,
            'F' => 16,
            'G' => 16,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 55,
            'L' => 15,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {

                $cellRange = 'A1:L1'; // All headers
                //    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');

                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                //    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);


            },
        ];
    }
    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'lastModifiedBy' => auth()->user()->name,
            'title'          => 'Exportar movimientos de maquinas de' . $this->dateStart . 'a' . $this->dateEnd,
            'description'    => 'Movimientos de maquinas',
            'subject'        => 'Movimientos de maquina',
            'keywords'       => 'Movimientos de maquina',
            'category'       => 'Movimientos de maquina',
            'manager'        => auth()->user()->name,
            'company'        => 'Cantera',
        ];
    }
    public function title(): string
    {
        $machine = MachineModel::getMachine($this->idMachine);
        if ($machine) {

            return $machine->MachineType->tmaq_nombre . ' ' . $machine->maqn_placa;
        }
        return 'Reporte de ' . $this->dateStart . 'a' . $this->dateEnd;
    }
}
// <?php

// namespace App\Exports;

// use App\Models\MachineMov;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;


// class MachineMovExport implements FromView
// {

//     // use Exportable;

//     protected $idMachine,$dateStart,$dateEnd;

//     public function __construct(int $idMachine, string $dateStart, string $dateEnd) {

//         $this->idMachine = $idMachine;
//         $this->dateStart = $dateStart;
//         $this->dateEnd = $dateEnd;

//     }
//     // /**
//     // * @return \Illuminate\Support\Collection
//     // */
//     public function view(): View {

//         $idMachine =$this->idMachine;
//         $machineMovs  = MachineMov::query();
//         $machineMovs->whereHas('Machine', function ($query) use ( $idMachine) {
//             $query->whereHas('Tankmachines', function ($query1) use ( $idMachine) {
//                 $query1->whereBetween('tanq_fecha', [$this->dateStart, $this->dateEnd]);
//              });
          
//          });
//          $machineMovs->where('mqmv_idmaquina',  $idMachine);
//          $machineMovs->whereBetween('created_at', [$this->dateStart, $this->dateEnd]);
//         //  $machineMovs->select('mqmv_finicio','mqmv_ffin','mqmv_vlrhora','created_at');
//         return view('reports.reportMachinesMov', [
//             'machinesMovs' =>  $machineMovs->get()
//         ]);
//     }
// }