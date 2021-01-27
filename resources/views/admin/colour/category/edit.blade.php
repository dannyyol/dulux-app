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
  <div id='app'>
    <div class="page-header">
    <h4 class="page-title">Edit Colour Category</h4>
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
        <a href="#">Edit Colour Category</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Colour Category</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.colourcategory.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm"  action="{{route('admin.colourcategory.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="mb-2">
                        <label for="image"><strong>Image</strong></label>
                      </div>
                      <div class="showImage mb-3">
                        @if (!empty($data->image))
                          <a class="remove-image" data-type="ccategory"><i class="far fa-times-circle"></i></a>
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
                  <input type="text" class="form-control" name="category_name" value="{{$data->category_name}}" placeholder="Enter name">
                  <p id="errname" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <label for="">Colour Code **</label>
                  <input type="text" class="form-control" name="category_code" value="{{$data->category_code}}" placeholder="Enter colour code">
                  <p id="errname" class="mb-0 text-danger em"></p>
                </div>

                <input type="hidden" name="colour_category_id" value="{{$data->id}}">


                <div class="form-group">
                  <label for="">Colour Palette **</label>
                    <select name="colour_palette_id" class="form-control">
                        <option value="" selected disabled>Select a category</option>
                        @foreach ($cpalettes as $cpal)
                            <option value="{{$cpal->id}}" @if($cpal->id == $data->colour_palette_id) {{ "selected" }} @endif>{{$cpal->palette_name}}</option>
                        @endforeach
                    </select>
                </div>


                {{-- <div class="form-group">
                  <label for="category">Category **</label>
                  <select  class="form-control categoryData" name="category_id" id="category" @change="fetchFilterField($event)">>
                      <option value="" selected disabled>Select a category</option>
                      @foreach ($categories as $categroy)
                      <option value="{{$categroy->id}}" {{$data->category_id == $categroy->id ? 'selected' : ''}}>{{$categroy->name}}</option>
                      @endforeach
                  </select>
                  <p id="errcategory_id" class="mb-0 text-danger em"></p>
                </div> --}}


                {{-- <div class="form-group">
                <label for="">Filter Field **</label>
                <select name="subcategory_id" class="form-control">
                    <option value="" selected disabled>Select field</option>
                   
                    <option :value="data.id" v-for="data in filterFields">@{{data.name}}</option>

                </select>
                <p id="errlanguage_id" class="mb-0 text-danger em"></p>
            </div> --}}

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
        fd.append('colour_category_id', {{$data->id}});

        $.ajax({
            url: "{{route('admin.colourcategory.rmv.img')}}",
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
                    filterFields: []
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