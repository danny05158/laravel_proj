@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
          <div class="row">
            <p>Today's News for {{$ticker_name}}</p>
          </div>
            @foreach($news as $news_data)
             <div class="card">
                 <div class="card-header">
                    <a  href="{{ $news_data->article_url }}"  target="_blank">
                    {{ $news_data->title}}
                    </a>
                   </div>
                 <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                          <img src="{{ $news_data->image_url }}" style="width:100%"/>
                        </div>
                        <div class="col-6">
                          <p>{{ $news_data->description }}</p>
                        </div>
                    </div>
                    <br>
                      <div class="row">
                      {{ $news_data->author }}
                      </div>
                 </div>
            </div>
            <br>
            @endforeach
        </div>

        <div class="col-md-3 order-md-2 mb-4">
           <div class="row">
              <p></p>
            </div>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Symbol</h6>
                <small class="text-muted">{{$ticker_simbol}}</small>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">CEO</h6>
                <small class="text-muted">{{$ticker_ceo}}</small>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Industry</h6>
                <small class="text-muted">{{$ticker_industry}}</small>
              </div>
            </li>
             <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">List Date</h6>
                <small class="text-muted">{{$list_date}}</small>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Market Cap</h6>
                <small class="text-muted">{{$ticker_mkcap}}</small>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Employees</h6>
                <small class="text-muted">{{$ticker_employees}}</small>
              </div>
            </li>
             <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">URL</h6>
                <small class="text-muted">{{$ticker_url}}</small>
              </div>
            </li>
             <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">HQ</h6>
                <small class="text-muted">{{$ticker_country, $ticker_state}}</small>
              </div>
            </li>
             <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Exchange</h6>
                <small class="text-muted">{{$ticker_exchange}}</small>
              </div>
            </li>
          </ul>
        </div>

    </div>
</div>
@endsection
