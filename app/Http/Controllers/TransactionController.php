<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transactions']=Transaction::select('transactions.*','inventories.name')
        ->leftJoin('inventories','inventories.id','transactions.inventory_id')
        ->get();
        // dd($data);
        return view('transaction.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function penjualan()
    {
        $data['inventories']=Inventory::all();
        return view('transaction.penjualan',$data);
    }

    public function pembelian()
    {
        $data['inventories']=Inventory::all();
        return view('transaction.pembelian',$data);
    }

    public function storePembelian(Request $request)
    {
        $request->validate([
            'inventory'=>'required',
            'stock'=>'required|min:1'
        ]);
        $inventory=Inventory::find($request->inventory);
        $inventory->stock+=$request->stock;
        $inventory->save();


        $pembelian =new Transaction();
        $pembelian->inventory_id=$request->inventory;
        $pembelian->amount=$request->stock;
        $pembelian->total=$request->stock* $inventory->price;
        $pembelian->status='PEMBELIAN';
        $pembelian->save();

        $data['name']=$inventory->name;
        $data['amount']=$request->stock;
        $data['price']=$inventory->price;
        $data['total']=$inventory->price*$request->stock;
        // dd($data);
        return redirect()->route('pembelian')->with( ['data' => $data] );


    }

    public function storePenjualan(Request $request)
    {
        $request->validate([
            'inventory'=>'required',
            'stock'=>'required|min:1'
        ]);
        $inventory=Inventory::find($request->inventory);
        if($request->stock>=$inventory->stock){
            return redirect()->back();
        }
        $inventory->stock-=$request->stock;
        $inventory->save();


        $pembelian =new Transaction();
        $pembelian->inventory_id=$request->inventory;
        $pembelian->amount=$request->stock;
        $pembelian->total=$request->stock* $inventory->price;
        $pembelian->status='PENJUALAN';
        $pembelian->save();

        $data['name']=$inventory->name;
        $data['amount']=$request->stock;
        $data['price']=$inventory->price;
        $data['total']=$inventory->price*$request->stock;
        // dd($data);
        return redirect()->route('pembelian')->with( ['data' => $data] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
