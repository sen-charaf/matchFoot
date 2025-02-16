<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joueur;
use Illuminate\Support\Facades\Validator;
use App\Models\Pay;

class JoueurContoller extends Controller
{
    public function index()
    {
        return Joueur::all();
    }

    public function show($id)
    {
        return Joueur::find($id);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required | string | max:30',
            'prenom' => 'required | string | max:30',
            'date_naissance' => 'required | date',
            'poid' => 'required | numeric | positive',
            'taill' => 'required | numeric | positive',
            'pied' => 'required | string | max:1',
            'photo' => 'required | file ',
            'nationalite' => 'required | string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        
        $nationalite_id = Pay::find($request->nationalite);

        if ($nationalite_id == null) {
            return response()->json(['error' => 'Nationalite not found'], 404);
        }

        $photo = $request->file('photo');
        $photo->store('public/photos/joueurs');
        $photo_path = $photo->hashName();

        $joueur = new Joueur();
        $joueur->nom = $request->nom;
        $joueur->prenom = $request->prenom;
        $joueur->date_naissance = $request->date_naissance;
        $joueur->poid = $request->poid;
        $joueur->taill = $request->taill;
        $joueur->pied = $request->pied;
        $joueur->photo_path = $photo_path;
        $joueur->nationalite_id = $nationalite_id->id;
        $joueur->save();

        return response()->json(['message' => 'Joueur created'], 201);


    }

    public function update(Request $request, $id)
    {
        $joueur = Joueur::find($id);

        if ($joueur == null) {
            return response()->json(['error' => 'Joueur not found'], 404);
        }


        return response()->json(['message' => 'Joueur updated'], 200);
    }
    

}
