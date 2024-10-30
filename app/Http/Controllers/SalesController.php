<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Session;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();

        if ($request->filled('client_id')) {
            if ($request->input('client_id') === 'none') {
                $query->whereNull('client_id'); 
            } else {
                $query->where('client_id', $request->input('client_id'));
            }
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        $clients = Client::all();
        $users = User::all();

        $sales = $query->get();

        return view('sales.index', compact('sales', 'clients', 'users'));
    }
    public function store(Request $request)
    {
        //dd($request->all())
        $request->validate([
            'products' => 'required',
            'client_id' => 'nullable|integer',
            'installment_values' => 'required|array',
            'due_dates' => 'required|array',
            'payment_methods' => 'required|array',
            'installment_values.*' => 'numeric|min:0',
            'due_dates.*' => 'date',
            'payment_methods.*' => 'in:card,pix,boleto',
        ]);        
    
        try {        
            $products = json_decode($request->input('products'), true);
            $clientId = $request->input('client_id');
            $installmentValues = $request->input('installment_values', []);
            $dueDates = $request->input('due_dates', []);
            $paymentMethods = $request->input('payment_methods', []);
            
            
            $total = 0;
            foreach ($products as $productId => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($productId);
                    if ($product) {
                        $total += $product->price * $quantity;
                    }
                }
            }

            $sale = Sale::create([
                'user_id' => auth()->id(),
                'client_id' => $clientId,
                'total' => $total,
            ]);

            foreach ($products as $productId => $quantity) {
                if ($quantity > 0) {
                    $prod = Product::where('id', $productId)->first();
                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'unit_price' => $prod->price,
                        'total_price' => $prod->price * $quantity,
                    ]);
                }
            }  

            foreach ($installmentValues as $index => $amount) {
                Installment::create([
                    'sale_id' => $sale->id,
                    'due_date' => $dueDates[$index],
                    'amount' => $amount,
                    'payment_method' => $paymentMethods[$index],
                ]);
            }
        } catch (\Throwable $th) {
            Session::flash('error', __('Ocorreu um erro'));
        }
        Session::flash('success', __('Sale registered successfully'));
        return redirect()->route('sales.index')->with('success', 'Sale completed successfully.');
    }
    public function edit($id)
    {
        $sale = Sale::with('client', 'user')->findOrFail($id);
        $clients = Client::all();

        return view('sales.edit', compact('sale', 'clients'));
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);


        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }

    public function download($id)
    {
        //função utilizando dompdf/dompdf ^2.0.7 tem versão mais recente...
        $sale = Sale::with(['client', 'user', 'saleItems'])->findOrFail($id);
        $pdf = Pdf::loadView('sales.summary', compact('sale'));
        return $pdf->download("resumo_venda_{$sale->id}.pdf");
    }
    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $request->validate([
            'client_id' => 'nullable|integer|exists:clients,id',
        ]);

        $sale->update([
            'client_id' => $request->input('client_id'),
        ]);       

        Session::flash('success', __('Sale updated successfully'));
        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }
}