<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dreams = DB::table('dreams')
        ->where('user_id', auth()->user()->id)
        ->get();

        $dreams->map(function($dream){
            $dream->created_at = Carbon::make($dream->created_at);
            $dream->updated_at = Carbon::make($dream->updated_at);
        });
        return view("admin.dreams.index",compact('dreams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dreams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' =>'required|max:255|string',
        ]);

        // $data = [
        //     'user_id' => auth()->user()->id,
        //     'content'=> $validated['content'],
        // ];

        $dream = DB::table('dreams')->insertGetId([
            ...$validated,
            'user_id' => auth()->user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        if($dream){
            return to_route('dreams.index');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return view('admin.dreams.show',[
        'dream'=> DB::table('dreams')->where('id',$id)->first(),
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dream = DB::table('dreams')
            ->where('id',$id)
            ->where('user_id',auth()->user()->id)
            ->first();

                if(!$dream){
                    return to_route('dreams.index');
                }

            return  view('admin.dreams.edit',compact('dream'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'content' =>'required|max:255|string',
        ]);

        $dream = DB::table('dreams')
        ->where('id',$id)
        ->where('user_id',auth()->user()->id)
        ->update([
            ...$validated,
            'updated_at'=> now()
        ]);

        // dd($dream);
        return to_route('dreams.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        $dream = DB::table('dreams')
        ->where([
            'id' => $id,
            'user_id' => auth()->user()->id
        ])->delete();

        return back();
    }
}
