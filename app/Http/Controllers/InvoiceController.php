<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Item;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['forAddress', 'fromAddress'])->get();
        return view('invoices', [
            'invoices'=>$invoices
        ]);
    }

    public function indexAPI()
    {
        $invoices = Invoice::with(['forAddress', 'fromAddress'])->get();
        return $invoices;
    }

    public function store(Request $request)
    {
        $items = explode(",", $request->items);
        $qtys = explode(",", $request->qtys);

        $invoice = New Invoice;
        $invoice->date = $request->issuedate;
        $invoice->duedate = $request->duedate;
        $invoice->subject = $request->subject;
        $invoice->from = $request->from;
        $invoice->for = $request->for;
        $invoice->save();

        for ($i=0; $i < count($items); $i++) { 
            $invoice->items()->attach($items[$i], ["qty" => $qtys[$i]]);
        }

        return redirect('/invoices');
    }

    public function destroy($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $invoice->items()->detach();
        $invoice->delete();
        return redirect('/invoices');
    }

    public function update(Request $request, $invoice_id)
    {
        $items = explode(",", $request->items);
        $qtys = explode(",", $request->qtys);

        $invoice = Invoice::find($invoice_id);
        $invoice->date = $request->issuedate;
        $invoice->duedate = $request->duedate;
        $invoice->subject = $request->subject;
        $invoice->from = $request->from;
        $invoice->for = $request->for;
        $invoice->save();

        $invoice->items()->detach();
        for ($i=0; $i < count($items); $i++) { 
            $invoice->items()->attach($items[$i], ["qty" => $qtys[$i]]);
        }
        return redirect('/invoices');
    }

    public function create()
    {
        $addresses = Address::all();
        $items = Item::all();
        return view('invoicesCreate', ['addresses' => $addresses, 'items' => $items]);
    }

    public function showAPI($invoice_id)
    {
        $invoice = Invoice::with(['forAddress', 'fromAddress', 'items'])->where('id', $invoice_id)->get();
        if (count($invoice) == 0 ){
            return abort(404);
        }
        return [
            'invoice'=>$invoice
        ];
    }

    public function edit($invoice_id)
    {
        // dd(Invoice::with(['forAddress', 'fromAddress', 'items'])->where('id', $invoice_id)->get()[0]->items[0]->getRawOriginal('pivot_qty'));
        return view('invoicesEdit', [
            'invoice'=>Invoice::with(['forAddress', 'fromAddress', 'items'])->where('id', $invoice_id)->get()[0],
            'addresses'=>Address::all(),
            'items'=>Item::all()
        ]);
    }

}
