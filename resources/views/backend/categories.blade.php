@extends('backend.layouts.master')

@section('title')
Blogging - Categories
@endsection

@section('styles')
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Categories</h1>
<div class="card shadow mb-4">
 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
  <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#addCategoryModal">Add Category</a>


 </div>
 <div class="card-body">
  The styling for this basic card example is created by using default Bootstrap
  utility classes. By using utility classes, the style of the card component can be
  easily modified with no need for any custom CSS!
 </div>
</div>

@include('backend.partials.categorymodal')
@endsection

@section('scripts')
<script src="{{ asset('backend/partials/category.js')}}"></script>
@endsection