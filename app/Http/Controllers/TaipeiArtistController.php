<?php

namespace App\Http\Controllers;

use App\Models\TaipeiArtist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaipeiArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // DB::enableQueryLog();
        // default setting
        $marker = $request->marker==null ? 1:$request->marker;
        $limit = $request->limit==null ? 100:$request->limit;
        // query all
        $query = TaipeiArtist::query()->orderBy('id', 'asc')->where('id', '>=', $marker);
        // 篩選欄位條件
        if ($request->query()) {
        foreach ($request->query() as $key => $value) {
                if($key === 'search')
                $query->where('name', 'LIKE', '%' . $value . '%')->orWhere('subcategoryDes','LIKE','%' . $value . '%')->get();
            }
        }
        $taipei_artists = $query->paginate($limit);
        // dd(DB::getQueryLog());
        return $taipei_artists;
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaipeiArtist  $taipeiArtist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $taipei_artist = TaipeiArtist::findOrFail($id);
        return $taipei_artist;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaipeiArtist  $taipeiArtist
     * @return \Illuminate\Http\Response
     */
    public function edit(TaipeiArtist $taipeiArtist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaipeiArtist  $taipeiArtist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaipeiArtist $taipeiArtist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaipeiArtist  $taipeiArtist
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaipeiArtist $taipeiArtist)
    {
        //
    }
}
