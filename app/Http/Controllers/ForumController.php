<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Pertanyaan;
use \App\User;
use \App\Jawaban;
use \App\Komen_Tanya;
use \App\Komen_Jawab;

class ForumController extends Controller
{
    
    public function index($pertanyaan_id){

        $data_tanya = Pertanyaan::findOrFail($pertanyaan_id);
        $data_jawab = Jawaban::where('pertanyaan_id', $pertanyaan_id);
        $data_user = User::findOrFail($data_tanya['user_id']);
        return view('user.detail_forum.index', [
            'data_tanya'=> $data_tanya,
            'data_jawab'=> $data_jawab,
            'data_user' => $data_user
        ]);

    }

    public function jawab($pertanyaan_id){

        $data_tanya = Pertanyaan::find($pertanyaan_id);
        $data_user = User::find($data_tanya['user_id']);
        return view('user.detail_forum.jawab', [
            'data_tanya' => $data_tanya,
            'data_user' => $data_user
        ]);

    }

    public function jawabcreate(Request $request){
        $isi = $request->all();
        unset($isi['_token']);
        $jawab = Jawaban::create($isi);

        return redirect('/pertanyaan/'. $isi['pertanyaan_id'] . '/detail');
    }

    public function komen_tanya($pertanyaan_id){

        $data_tanya = Pertanyaan::find($pertanyaan_id);
        $data_user = User::find($data_tanya['user_id']);
        return view('user.detail_forum.komentar_pertanyaan', [
            'data_tanya' => $data_tanya,
            'data_user' => $data_user
        ]);

    }

    public function komen_tanyacreate(Request $request){
        $isi = $request->all();
        unset($isi['_token']);

        $komen = Komen_Tanya::create($isi);
        
        // dd($isi);

        return redirect('/pertanyaan/'. $isi['pertanyaan_id'] . '/detail');
    }

    public function komen_jawabcreate(Request $request){
        $isi = $request->all();
        unset($isi['_token']);

        $pertanyaan_id = $isi['pertanyaan_id'];

        unset($isi['pertanyaan_id']);
       
        $komen = Komen_Jawab::create($isi);
    

        return redirect('/pertanyaan/'. $pertanyaan_id . '/detail');
    }

    public function komen_jawab($jawaban_id){

        // $data_jawab = Jawaban::select('pertanyaan_id')->where('pertanyaan_id', $pertanyaan_id)->get();
        $data_jawab = Jawaban::find($jawaban_id);
        $data_user = User::find($data_jawab['user_id']);
        return view('user.detail_forum.komentar_jawaban', [
            'data_jawab' => $data_jawab,
            'data_user' => $data_user
        ]);

    }

}
