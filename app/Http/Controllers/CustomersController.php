<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Transactions;
use Validator;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer = Customer::with('transactions')->orderBy('created_at')->paginate(10);
        return $customer;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //validar todos los datos que vengan en el request
        $validate = Validator::make($request->all(), [
            'first_name' => 'required|min:5|max:16|string',
            'last_name'  => 'required|min:5|max:16|string',
            'email'      => 'required|email|unique:customers,email',
        ]);
        if ($validate->fails()) {

            //si la validacion falla se envia un mensaje indicando que el formulario esta mal junto con los errores que marque el formulario
            return response([
                'menssage' => 'El Formulario Contiene Errores!',
                'errors'   => $validate->errors(),
            ], 401);
            //mostrar todo lo que lleva el request en un array
            //dd($request->all());
            //
            //ya tenemos los datos validados}
            //ahora procedemos a guardarlos
        }

        $customer = Customer::create($request->all());

            //
            if ($customer)
            //responde con un binario en caso de que el cliente se haya creadoo
            {

                return response([
                    'menssage' => trans('app.customer_create_success_menssage'),
                    'id'       => $customer->id,
                ], 200);
            }

            return response([
                'menssage' => trans('app.customer_create_fail_menssage')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Customers::findOrFile($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $validate = Validator::make($request->all(), [
            'first_name' => 'required|min:5|max:16|string',
            'last_name'  => 'required|min:5|max:16|string',
            'email'      => 'required|email|unique:customers,email,'.$id. ',id',
        ]);
        if ($validate->fails()) {

            //si la validacion falla se envia un mensaje indicando que el formulario esta mal junto con los errores que marque el formulario
            return response([
                'menssage' => 'El Formulario Contiene Errores!',
                'errors'   => $validate->errors(),
            ], 401);
            //mostrar todo lo que lleva el request en un array
            //dd($request->all());
            //
            //ya tenemos los datos validados}
            //ahora procedemos a guardarlos
        } 

        $customer = Customer::find($id);

        $customer->update($request->all());


        return response([
            'menssage' => 'Guardado', 
            'id' => $id]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $customer = Customer::destroy($id);

        if ($customer) {
            return response([
                'mensaje' => 'Cliente Eliminado!',
                'id'      => $id,
            ], 200);
        }
        return response([
            'mensaje' => 'No Se Pudo Eliminar El Cliente',
            'id'      => $id,
        ], 401);
    }
}
