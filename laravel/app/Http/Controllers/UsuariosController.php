<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = User::all();
        //return $usuarios;
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $usuarios = User::all();
        return view('usuarios.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        //
        User::create([
            'name' => $request->get('name'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        return redirect('admin/usuarios');
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
        $usuarios = User::all();
        $usuario = User::find($id);
        
        return view('usuarios.edit', compact('usuarios', 'usuario'));
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
        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'min:6|confirmed',
        ]);
        $usuario = User::find($id);
        if ($usuario->password == $request->get('password')){
            //echo "no guardar pass";
            $usuario->update([
                'name' => $request->get('name'),
                'apellido' => $request->get('apellido'),
                'email' => $request->get('email'),
            ]);
        }else{
            //echo "guardar pass";
            $usuario->update([
                'name' => $request->get('name'),
                'apellido' => $request->get('apellido'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);
        }

        return redirect('admin/usuarios');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario = User::find($id);
        $usuario->delete();

        return redirect('admin/usuarios');

    }
}
