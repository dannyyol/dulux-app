@extends('admin.layout')

@php
$selLang = \App\Models\Language::where('code', request()->input('language'))->first();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='language'] {
        direction: rtl;
    }
    form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
{{-- <div id='app'> --}}
    <div class="page-header">
    <h4 class="page-title">Colour Categories</h4>
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
        <a href="#">Colour Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Category</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block">Categories</div>
                </div>
                <div class="col-lg-3">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                    <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add Category</a>
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('admin.colourcategory.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($ccategories) == 0)
                <h3 class="text-center">NO PRODUCT CATEGORY FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">Name</th>
                        <th scope="col">Colour</th>
                        <th scope="col">Image</th>
                        <th scope="col">Colour Palette</th>
                        <th scope="col">Status</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ccategories as $key => $category)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{$category->id}}">
                          </td>

                          <td>{{convertUtf8($category->category_name)}}</td>
                          <td style="background-color:{{ $category->category_code ?? null }}"></td>
                          <td><img src="{{$category->image ? asset('assets/front/img/colour/'.$category->image) : asset('assets/admin/img/noimage.jpg')}}" width="100" alt=""></td>
                          <td>{{ $category->cpalettes->palette_name ?? null }}</td>
                          <td>
                            @if ($category->status == 1)
                              <h2 class="d-inline-block"><span class="badge badge-success">Active</span></h2>
                            @else
                              <h2 class="d-inline-block"><span class="badge badge-danger">Deactive</span></h2>
                            @endif
                          </td>
                          <td><input type="checkbox" class="featCcat" class="form-control" name="is_feature" data="{{$category->id}}" {{$category->is_feature == 1 ? 'checked' : ''}} value="1"></td>
                          <td>
                            <a class="btn btn-secondary btn-sm editbtn" href="{{route('admin.colourcategory.edit', $category->id) . '?language=' . request()->input('language')}}">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              Edit
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.colourcategory.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="colour_category_id" value="{{$category->id}}">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                Delete
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="d-inline-block mx-auto">
              {{$ccategories->appends(['language' => request()->input('language')])->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Create Service Category Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Colour Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxForm" class="modal-form" action="{{route('admin.colourcategory.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="col-12 mb-2">
                    <label for="image"><strong>Image</strong></label>
                  </div>
                  <div class="col-md-12 showImage mb-3">
                    <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                  </div>
                  <input type="file" name="image" id="image" class="form-control image">
                  <p id="errimage" class="mb-0 text-danger em"></p>
                </div>
              </div>
            </div>
            <div class="form-group">
                <label for="">Language **</label>
                <select name="language_id" class="form-control">
                    <option value="" selected disabled>Select a language</option>
                    @foreach ($langs as $lang)
                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                    @endforeach
                </select>
                <p id="errlanguage_id" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Name **</label>
              <input type="text" class="form-control" name="category_name" value="" placeholder="Enter name">
              <p id="errcategory_name" class="mb-0 text-danger em"></p>
            </div>

            <div class="form-group">
              <label for="">Colour Code **</label>
              <input type="text" class="form-control" name="category_code" value="" placeholder="Enter name">
              {{-- <p id="errname" class="mb-0 text-danger em"></p> --}}
            </div>


            <div class="form-group">
                <label for="">Colour Palette **</label>
                <select name="colour_palette_id" class="form-control">
                    <option value="" selected disabled>Select a category</option>
                    @foreach ($cpalettes as $palette)
                        <option value="{{$palette->id}}">{{$palette->palette_name}}</option>
                    @endforeach
                </select>
                <p id="errcolour_palette_id" class="mb-0 text-danger em"></p>
            </div>
      
            


            {{-- <div class="form-group">
              <label for="category">Category (Filter)**</label>
              <select  class="form-control categoryData" name="category_id" id="category" v-model="selectCategory" @change="fetchFilterField()">
                <option value="" selected disabled>Select a category</option>
                <option :value="data.id" v-for="data in pcategories">@{{data.name}}</option>
              </select>
              <p id="errcategory_id" class="mb-0 text-danger em"></p>
          </div> --}}


            {{-- <div class="form-group">
                <label for="">Filter Field **</label>
                <select name="subcategory_id" class="form-control">
                    <option value="" selected disabled>Select field</option>

                    <option :value="data.id" v-for="data in filterFields">@{{data ? '' : data.name}}</option>
                </select>
                <p id="errlanguage_id" class="mb-0 text-danger em"></p>
            </div> --}}
            

            <div class="form-group">
              <label for="">Status **</label>
              <select class="form-control ltr" name="status">
                <option value="" selected disabled>Select a status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
              <p id="errstatus" class="mb-0 text-danger em"></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
          {{-- <button type="button" @click="fetchCategory()">add</button> --}}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('vuescripts')
    <script>
        let app = new Vue({
            el: '#app',
            data() {
                return  {
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
              fetchFilterField(){
                // alert('field')
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
