<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Annonce;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('annonce.index',compact('annonceIndex'))->with('annonces', Annonce::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('annonce.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* request()->validate([
            'title' => 'required',
            'desc' => 'required',
            'photo' => 'required|image',
            'price' => 'required|integer'
        ]);

        Annonce::create($request->all());
        $newId = Annonce::max('id');

        $file            = Input::file('photo');
        $destinationPath = public_path().'/uploads/annonce/';
        $filename        = $newId.'.'.$file->getClientOriginalExtension();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        
        $annonce = Annonce::find($newId);
        $annonce->photo = '/uploads/annonce/'.Annonce::max('id').'.'.$file->getClientOriginalExtension();
        $annonce->save();
        return redirect()->route('annonceIndex')
                        ->with('success','Annonce créée avec succès'); */
        
        request()->validate([
            'title' => 'required',
            'desc' => 'required',
            'price' => 'required|integer'
        ]);

        Annonce::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'photo' => "",
            'price' => $request->price,
            'id_author' => $request->id_author
            ]);
        $files = $request->file('photo');
        $i = 1;
        $newId = Annonce::max('id');
        $DBChemin = "";
        foreach($files as $file){
                $destinationPath = public_path().'/uploads/annonce/'.$newId.'/';
                $filename        = $newId.'-'.$i.'.'.$file->getClientOriginalExtension();
                $file->move($destinationPath, $filename);
                $DBChemin = $DBChemin . "/uploads/annonce/".$newId."/" . $newId . '-'.$i.'.'.$file->getClientOriginalExtension() ."#";
                $i++;
        }
        $annonce = Annonce::find($newId);
        //$annonce = Annonce::find($newId);
        $annonce->photo = $DBChemin;
        $annonce->save(); 
        return redirect()->route('annonceIndex')
                        ->with('success','Annonce créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $annonce = Annonce::find($id);
        return view('annonce.show',compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $annonce = Annonce::find($id);
        return view('annonce.edit');
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
        $annonce = Annonce::find($id);
        $this->validate(request(), [
            'title' => 'required',
            'desc' => 'required',
            'price' => 'required|integer',
        ]);
        $files           = $request->file('photo');
        $destinationPath = public_path().'/uploads/annonce/'.$id.'/';
        $annonce->title = request('title');
        $annonce->desc = request('desc');
        $DBChemin = "";
        $i =1;
        foreach($files as $file){
                $destinationPath = public_path().'/uploads/annonce/'.$id.'/';
                $filename        = $id.'-'.$i.'.'.$file->getClientOriginalExtension();
                $file->move($destinationPath, $filename);
                $DBChemin = $DBChemin . "/uploads/annonce/".$id."/" . $id . '-'.$i.'.'.$file->getClientOriginalExtension() ."#";
                $i++;
        }
        //$annonce = Annonce::find($newId);
        $annonce->photo = $DBChemin;
        $annonce->price = request('price');

        $annonce->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Annonce::find($id)->delete();
        return redirect()->route('annonces.index')
                        ->with('success','Annonce supprimée');
    }

    public function search(){
        $q = Input::get ( 'q' );
        if(Input::get ( 'order' ) != ""){
        $order = Input::get ( 'order' );
        }else{
            $order = "title";
        }
        $annonce = Annonce::where( 'title', 'LIKE', '%' . $q . '%' )->orWhere ( 'desc', 'LIKE', '%' . $q . '%' )->orderBy($order, 'desc')->paginate(5);
        $annonce->appends(['q' => $q]);
        $annonce->appends(['order' => $order]);
        
        if (count ( $annonce ) > 0)
            return view ( 'annonce.result', compact('annonce', 'q') )->withDetails ( $annonce )->withQuery ( $q )->with('annonces', $annonce);
            //return view('user.index',compact('users'));
        else
            return view ( 'annonce.noResult' )->withMessage ( 'Aucun résultat' );
        }
}
