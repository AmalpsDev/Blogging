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
    <table class="table table-striped table-bordered w-100" id="categories">
     <thead>
      <tr>
       <th scope="col">#</th>
       <th scope="col">Name</th>
       <th scope="col">Created At</th>
       <th scope="col">Updated At</th>
       <!-- <th scope="col">Edit</th>
       <th scope="col">Delete</th> -->
      </tr>
     </thead>
    </table>
 </div>
</div>

@include('backend.partials.categorymodal')
@endsection

@section('scripts')
<script src="{{ asset('backend/partials/category.js')}}"></script>
@endsection