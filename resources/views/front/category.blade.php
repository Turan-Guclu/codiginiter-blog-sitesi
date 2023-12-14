@extends('front.layouts.master')
@section('title',$category->name.' Kategorisi | '.count($articles).' Yazı Bulundu' )
@section('content')
@include('front.widgets.articleList')
@include('front.widgets.categoryWidget')
@endsection