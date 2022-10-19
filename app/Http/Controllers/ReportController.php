<?php

namespace App\Http\Controllers;

use App\Exports\MachineMovExport;
use App\Models\Client;
use App\Models\Construction;
use App\Models\Machine;
use App\Models\MachineTanking;
use App\Models\Remission;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use Excel;
use Session;



class ReportController extends Controller {

   public function index(Request $request) {
      //   dd( $request->all());
      $machines = Machine::all();

      $inventories = MachineTanking::query();

      if (isset($request->search)) {

         $inventories->whereHas('Machine', function ($query) use ($request) {
            $query->where("maqn_placa",  $request->search);
         });
      }
      if (isset($request->searchOrigin)) {

         $inventories->whereHas('MachineCub', function ($query) use ($request) {
            $query->where("maqn_placa",  $request->searchOrigin);
         });
      }


      if (isset($request->dateStart)) {
         $inventories->whereDate('created_at', $request->dateStart);
      }
      if (isset($request->dateStart) && isset($request->dateEnd)) {
         $inventories->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
      }

      if (isset($request->tanq_origen)) {
         $inventories->where('tanq_origen', $request->tanq_origen);
      }
      if (isset($request->tanq_unidad)) {
         $inventories->where('tanq_unidad', $request->tanq_unidad);
      }

      // $maqn_tipo = 7;
      $count = $inventories->count();
      // dd($count);
      $inventories = $inventories->paginate(5);
      if ($count > 0) {

         return view('reports.index', compact('machines', 'request', 'inventories'));
      } else {

         Session::forget('info_message');
         Session::flash('info_message', 'No se puede generar un reporte, porque no tenemos información al respecto');
         return view('reports.index', compact('inventories', 'machines', 'request'));
         // return redirect()->route('reports','machines', 'inventories');
      }
   }

   public function reportDocument(Request $request) {
      Session::forget('info_message');
      $inventories = MachineTanking::query();
      $date = date("d") . " del " . date("m") . " de " . date("Y");
      $user = Auth::user();
      if (isset($request->search)) {

         $inventories->whereHas('Machine', function ($query) use ($request) {
            $query->where("maqn_placa",  $request->search);
         });
      }
      if (isset($request->searchOrigin)) {

         $inventories->whereHas('MachineCub', function ($query) use ($request) {
            $query->where("maqn_placa",  $request->searchOrigin);
         });
      }


      if (isset($request->dateStart)) {
         $inventories->whereDate('created_at', $request->dateStart);
      }
      if (isset($request->dateStart) && isset($request->dateEnd)) {
         $inventories->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
      }

      if (isset($request->tanq_origen)) {
         $inventories->where('tanq_origen', $request->tanq_origen);
      }
      if (isset($request->tanq_unidad)) {
         $inventories->where('tanq_unidad', $request->tanq_unidad);
      }


      $inventories = $inventories->orderBy('id','DESC')->get();

      if (count($inventories) == 0) {
         Session::flash('info_message', 'No se puede generar un reporte, porque no tenemos información al respecto');
         return redirect()->route('reports');
      } else {
         $pdf = PDF::loadView('reports.report', compact('inventories', 'date', 'user', 'request'));
         return $pdf->stream("report_$date");
         // $name = "Reporte $date.pdf";
         // return $pdf->download($name);
      }
   }
   public function reportRemissions(Request $request) {

      $remissions  = Remission::query();
      Session::forget('info_message');
      if (isset($request->idConstruction)) {

         $remissions->whereHas('Construction', function ($query) use ($request) {
            $query->where('id', $request->idConstruction);
         });
      }
      if (isset($request->idClient)) {
         $remissions->whereHas('Construction', function ($query) use ($request) {
            $query->whereHas('Client', function ($queryC) use ($request) {
               $queryC->where('id', $request->idClient);
            });
         });
      }


      if (isset($request->dateStart) && isset($request->dateEnd)) {

         $remissions->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
      }

      if ($request->stateInvoice == 1) {
         $remissions->where('remi_numfactura','!=','');
      }
   
      if ( $request->stateInvoice == 0) {
         $remissions->where('remi_numfactura','=','');
      }
      $remissions = $remissions->orderBy('id','DESC')->get();

      $clients  = Client::all();
      $constructions  = Construction::all();
      return view('reports.report_remissions', compact('request', 'clients', 'remissions', 'constructions'));
   }
   public function pdfReportRemissions(Request $request) {
      $date = date("d") . " del " . date("m") . " de " . date("Y");
      $remissions  = Remission::query();
      $user = Auth::user();
      if (isset($request->idConstruction)) {

         $remissions->whereHas('Construction', function ($query) use ($request) {
            $query->where('id', $request->idConstruction);
         });
      }
      if (isset($request->idClient)) {
         $remissions->whereHas('Construction', function ($query) use ($request) {
            $query->whereHas('Client', function ($queryC) use ($request) {
               $queryC->where('id', $request->idClient);
            });
         });
      }
 
      if (isset($request->stateInvoice) && $request->stateInvoice == 1) {
       
         $remissions->whereNotNull('remi_numfactura');
      }
      if (isset($request->stateInvoice) && $request->stateInvoice == 0) {
        
         $remissions->whereNull('remi_numfactura');
      }
      if (isset($request->dateStart) && isset($request->dateEnd)) {

         $remissions->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
      }

      $remissions = $remissions->get();

      
      if (count($remissions) == 0) {
         Session::flash('info_message', 'No se puede generar un reporte de remisión, porque no tenemos información al respecto');
         return redirect()->route('reports');
      } else {
         $pdf = PDF::loadView('reports.reportRemissions', compact('remissions', 'date', 'user', 'request'));

         $name = "Reporte de remisiones $date.pdf";
         return $pdf->stream("$name");
         // return $pdf->download($name);
      }

   }
   public function reportMachineMov(Request $request)
   {
  
      $name = "Movimiento de maquina de  $request->dateStart a $request->dateEnd.xlsx";
      return Excel::download(new MachineMovExport($request->idMachine, $request->dateStart, $request->dateEnd), $name);
   
   }
   public function pdfReportRemissionAssignments(Request $request)
   {
      // dd($request->all());
      $user = Auth::user();
      $date = date("d") . " del " . date("m") . " de " . date("Y");
      $remissiondatas  = Remission::query();

      if (isset($request->dateStart) && isset($request->dateEnd) && !$request->dateEnd) {
         $remissiondatas->whereDate('remi_fecha', $request->dateStart);
      }

      if (isset($request->idConstruction) && !$request->idConstruction) {
         $remissiondatas->where('id_obra', $request->idConstruction);
      }

      if (isset($request->dateStart) && isset($request->dateEnd)) {
       
         $remissiondatas->whereBetween('remi_fecha', [$request->dateStart, $request->dateEnd]);
      }
      $remissions = $remissiondatas->get();
      $pdf = PDF::loadView('reports.reportAssignmentRemissions', compact('remissions', 'date', 'user', 'request'));

      $name = "Pre reporte de asignación de factura a remisiones de $request->dateStart a $request->dateEnd.pdf";
      return $pdf->stream("$name");

   }
}
