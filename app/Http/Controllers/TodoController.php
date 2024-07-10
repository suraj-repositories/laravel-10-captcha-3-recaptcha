<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('todos', compact('todos'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ]);

        $todo = Todo::create($validated);
        return redirect('/')->with('success', 'created successfully!');
    }

    public function destroy(Todo $todo){
        $todo->delete();
        return redirect('/')->with('success', 'deleted successfully!');
    }

}
