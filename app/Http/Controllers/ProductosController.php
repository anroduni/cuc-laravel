<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Productos;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use DateTime;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Input;
use Storage;
 

class ProductosController extends Controller
{
    //
    public function index(){
        $productos->Productos::all();
        return view("admin.productos.index", compact("productos"));
    }

    // Visualizar la pantalla de crea producto
    public function crear(){
        $productos = Productos::all();
        return view("admin.productos.crear",compact("productos"));    
    }
    
    //Basicamente es el insert de un registro a bd
    public function store(ItemCreateRequest $request){
        $productos=new Productos();
        $productos->nombre =  $request->nombre;
        $productos->precio =  $request->precio;
        $productos->stock  =  $request->stock;
        $productos->img    =  $request->file("img")->store("/");
        $productos->created_at = (new DateTime)->getTimestamp();
        $productos->save();

        return redirect("admin/productos")->with("message", "Producto guardado correctamente");

    }

    //Muestra la interfas del detalle de un producto
    public function show($id){
            $productos=Productos::find($id);
            return view("admin.productos.detalles", compact("productos"));

    }

    public function actualizar(){
        $productos=Productos::find($id);
        return view("admin.productos.actualizar",["productos"=>$productos]);

    }        

    public function update(ItemUpdateRequest $request){
        $productos=Productos::find();
        $productos->nombre=$request->nombre;
        $productos->precios=$request->precios;
        $productos->stock=$request->stock;

        if ($request->hasFile("img")) {
            $productos->img = $request->file("img")->store("/");
        }

        $productos->updated_at=(new DateTime)->getTimestamp();
        $productos->save();

        Session::flash("message","Producto actualizado correctamente");
        return Redirect::to("admin/productos");
    }

    public function eliminar(){
        $productos=Productos::find();
        $imagen = explode("," $productos->img);
        Storage::delete($imagen);

        Productos::destroy($id);
        Session::flash("message", "Eliminado Satisfactoriamente !");
        return Redirect::to("admin/productos");
    }

    }


