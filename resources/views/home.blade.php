<?php 

    use Illuminate\Support\Facades\Auth;
    use \App\Pertanyaan_Tag; 
    use \App\Tag;
    use \App\Vote_Pertanyaan;
    use Illuminate\Support\Facades\DB;

?>

@extends('layouts.app')

<style>

    .card.main{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

</style>

@section('title', 'Daftar Pertanyaan')

@section('content')

@foreach ($data_tanya ?? '' as $item)
<div class="card mb-2">
    <div class="card-header bg-primary text-white">
        Dari : {{$item->name}}
    </div>
    <div class="card-body bg-warning">
        <div class="row">
            <div class="col-md-2 col-sm-12 text-center">
                <div class="card border-0 bg-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{url('user/vote-tanya/' . $item->id . '/' . Auth::id() . '/up')}}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-up"></i>
                                </a>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="#" class="btn btn-secondary">
                                    <?php
                                        
                                        $up_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$item->id, 'up_down'=>true])
                                                ->count();
                                        $down_vote = DB::table('vote_pertanyaan')->where(['pertanyaan_id'=>$item->id, 'up_down'=>false])
                                                ->count();
                                                
                                        echo $up_vote - $down_vote;

                                    ?>
                                </a>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="{{url('user/vote-tanya/' . $item->id . '/' . Auth::id() . '/down')}}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-sm-12">
                <h5 class="card-title" style="font-weight: bold">{{$item->judul}}</h5>

                <p p class="card-text">{!!$item->isi!!}</p>
                <div class="tag">
                    <?php
                    
                        $tag = Pertanyaan_Tag::where('pertanyaan_id', $item->id)
                                                ->get();
                    ?>
                    @foreach ($tag as $tag_id)
                        <?php
                            $tag_name = DB::table('tag')
                                    ->select(DB::raw('nama_tag'))
                                    ->where('id', $tag_id->id)->get();
                        ?>
                        <button type="button" class="btn btn-info">{{$tag_name[0]->nama_tag}}</button>
                    @endforeach
                </div>
            </div>
        </div>
        
        <a href="{{url('/pertanyaan/'. $item->id)}}" class="btn btn-success mt-3" style="float: right"><i class="fa fa-eye"></i> Detail</a>
    </div>
</div>
@endforeach

@endsection
