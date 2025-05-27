<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when($request->level, function($query) use ($request) {
            return $query->where('level', $request->level);
        })->get();
        return view('Backend.user.select',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.user.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required | min:3',
        ]);

        User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'level' => $request->level,
        ]);

        return redirect('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('id',$id)->get();
        $levels = User::where('level', $users[0]['level']);
        $jumlah = $levels->count();

        if ($jumlah ==1) {
            session()->flash('pesan','Data hanya 1 tidak bisa dihapus !');
        } else {
            USer::where('id',$id)->delete();
        }
        
        return redirect('admin/user');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('Backend.user.update',['user' => $user]);
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
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:3',
            'level' => 'required'
        ]);

        User::where('id',$id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'level' => $data['level']
        ]);

        return redirect('admin/user');
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
    }
}
