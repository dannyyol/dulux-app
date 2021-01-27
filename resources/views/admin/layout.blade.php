<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
	<title>{{$bs->website_title}}</title>
	<link rel="icon" href="{{asset('assets/front/img/'.$bs->favicon)}}">
	@includeif('admin.partials.styles')
    @php
        $selLang = App\Models\Language::where('code', request()->input('language'))->first();
    @endphp
    @if (!empty($selLang) && $selLang->rtl == 1)
    <style>
    #editModal form input,
    #editModal form textarea,
    #editModal form select {
        direction: rtl;
    }
    #editModal form .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
    </style>
    @endif

    @yield('styles')

</head>
<body data-background-color="dark">
	<div class="wrapper">

    {{-- top navbar area start --}}
    @includeif('admin.partials.top-navbar')
    {{-- top navbar area end --}}


    {{-- side navbar area start --}}
    @includeif('admin.partials.side-navbar')
    {{-- side navbar area end --}}


		<div class="main-panel">
        <div class="content">
            <div class="page-inner">
            @yield('content')
            </div>
        </div>
            @includeif('admin.partials.footer')
		</div>

	</div>

	@includeif('admin.partials.scripts')

    {{-- Loader --}}
    <div class="request-loader">
        <img src="{{asset('assets/admin/img/loader.gif')}}" alt="">
    </div>
    {{-- Loader --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

{{-- <script src="https://unpkg.com/vue-multiselect@2.1.0"></script> --}}
<style>
       .select2-container--default .select2-selection--multiple {
         background-color: #1a2035;
         border: 1px solid #2f374b;
         border-radius: .25rem;
         height: calc(2.25rem + 2px);
       }

    </style>
</body>
</html>
