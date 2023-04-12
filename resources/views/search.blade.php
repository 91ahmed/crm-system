@extends('layouts.app')
@section('title', 'Search')

@section('content')
    
    @include('layouts/header')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Search</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Search Result:</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div>
			<div>
                <div class="row">
                    <div class="col-12">

                        <div class="table-responsive border-bottom" data-toggle="lists">
                            <table class="table mb-0 thead-border-top-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Preview</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="staff02">
                                	@if($name !== '')
                                	<tr>
                                        <td>
                                        	<a href="{{ url($view) }}" class="text-dark">
                                            	<span class="js-lists-values-employee-name">{{ ucfirst($name) }}</span>
                                        	</a>
                                        </td>
                                        <td>
                                        	<a href="{{ url($view) }}" class="btn btn-light btn-sm">Preview</a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="text-center">
                                    	<td colspan="3">No Result Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    
    @include('layouts/footer')

@endsection