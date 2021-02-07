@extends('admin.layout')

@if(!empty($data->language) && $data->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
        direction: rtl;
    }
    .nicEdit-main {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div id="app">
    <div class="page-header">
    <h4 class="page-title">Edit Product Colour</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Service Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Edit Product Colour</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Product Colour</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.productcolour.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm"  action="{{route('admin.productcolour.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="mb-2">
                        <label for="image"><strong>Image</strong></label>
                      </div>
                      <div class="showImage mb-3">
                        @if (!empty($data->image))
                          <a class="remove-image" data-type="pcolour"><i class="far fa-times-circle"></i></a>
                        @endif
                        <img src="{{!empty($data->image) ? asset('assets/front/img/colour/'.$data->image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                      </div>
                      <input type="file" name="image" id="image" class="form-control image">
                      <p id="errimage" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Name **</label>
                  <input type="text" class="form-control" name="colour_name" value="{{$data->colour_name}}" placeholder="Enter colour name">
                  <p id="errcolour_name" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <label for="">Colour Code **</label>
                  <input type="text" class="form-control" name="colour_code" value="{{$data->colour_code}}" placeholder="Enter colour code">
                  <p id="errcolour_code" class="mb-0 text-danger em"></p>
                </div>
                <input type="hidden" name="product_colour_id" value="{{$data->id}}">


                <div class="form-group">
                  <label for="">Colour Category **</label>
                    <select name="colour_category_id" class="form-control">
                        @foreach ($ccategories as $ccat)
                      <option value="{{$ccat->id}}" {{$data->colour_category_id == $ccat->id ? 'selected' : ''}}>{{$ccat->category_name}}</option>
                        @endforeach
                    </select>
                    <p id="errcolour_category_id" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <label for="colour_stages">Product Colour Stages**</label>
                  <select class="form-control" name="colour_stages">
                    <option value="" selected disabled>Select a status</option>
                    <option value=0 {{$data->colour_stages == 0 ? 'selected' : ''}}>Colours ready to buy </option>
                    <option value=1 {{$data->colour_stages == 1 ? 'selected' : ''}}>Colours to be mixed in store</option>
                  </select>
                  <p id="errcolour_stages" class="mb-0 text-danger em"></p>
                </div>

                
            <div class="form-group">
              <label for="category">Category (Filter)**</label>
              <select  class="form-control categoryData formselect required" id="sub_category_name" name="category_id">
                <option value="" selected disabled>Select a category</option>
                @foreach ($categories as $categroy)
                <option value="{{$categroy->id}}" {{$data->category_id == $categroy->id ? 'selected' : ''}}>{{ucfirst($categroy->name)}}</option>

                @endforeach
                {{-- <option :value="data.id" v-for="data in pcategories">@{{data.name}}</option> --}}
              </select>
              <p id="errcategory_id" class="mb-0 text-danger em"></p>
          </div>

            <div class="form-group">
              <label for="">Subcategory (Filter) **</label>
                <select style="width:100%" class="js-example-basic-multiple formselect" name="subcategory_id[]" placeholder="Select Sub Category" id="sub_category" multiple="multiple">
                </select>
                <p id="errsubcategory_id" class="mb-0 text-danger em"></p>
            </div>

            
                
                <div class="form-group">
                  <label for="">Status **</label>
                  <select class="form-control ltr" name="status">
                    <option value="" selected disabled>Select a status</option>
                    <option value="1" {{$data->status ==1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{$data->status ==0 ? 'selected' : ''}}>Deactive</option>
                  </select>
                  <p id="errstatus" class="mb-0 text-danger em"></p>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>

@endsection

@section('scripts')
<script>
$(function ($) {
  "use strict";

    $(".remove-image").on('click', function(e) {
        e.preventDefault();
        $(".request-loader").addClass("show");

        let type = $(this).data('type');
        let fd = new FormData();
        fd.append('type', type);
        fd.append('product_colour_id', {{$data->id}});

        $.ajax({
            url: "{{route('admin.productcolour.rmv.img')}}",
            data: fd,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                }
            }
        })
    });
});

$(document).ready(function() {
      $('.js-example-basic-multiple').select2().val({!! json_encode($data->subcategory()->allRelatedIds()) !!}).trigger('change');
  });



  $(document).ready(function () {
                $('#sub_category_name').on('change', function () {
                let id = $(this).val();
                $('#sub_category').empty();
                $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                type: 'POST',
                url: '/api/pcategory/subcategory/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);   
                $('#sub_category').empty();
                // $('#sub_category').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
                response.forEach(element => {
                    $('#sub_category').append(`<option value="${element['id']}">${element['name']}</option>`);
                    });
                }
            });
        });
    });
    
  
</script>
@endsection


@section('vuescripts')
    <script>
        let app = new Vue({
            el: '#app',
            data() {
                return  {
                  category_id : {!! $data->category_id  !!},
                    pcategories: [],
                    selectCategory:'',
                    filterFields: [],
                    colour_category_id:null
                }
            },
            methods: {
              fetchCategory(){

                axios.post("/api/pcategory-list/", { 
                  request_for : 'pcategory'
                })
                .then((response) => {
                      this.pcategories = response.data
                      this.filterFields = null
                      // this.fetchFilterField()
                })
              },
              fetchFilterField(evt){
                this.selectCategory = evt.target.value
                axios.post("/api/pcategory/subcategory",{
                  category_id : this.selectCategory
                })
                .then((response) => {
                  this.filterFields = response.data
                })

              }
            },
            created(){
              this.fetchCategory()

            }
        });
    </script>
@endsection