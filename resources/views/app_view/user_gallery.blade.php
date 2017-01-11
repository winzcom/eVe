@extends('layouts.app')

@section('content')
    <div>
    </div>
    <!--<div class="container">
        <div class="" style="margin-bottom:10px;">
            <img src="{{asset('/images/be.jpg')}}" width="400" height=auto>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <form>
                <thead>
                    <tr>
                        <th></th>
                        <th>S/N</th>
                        <th>Images</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>1</td>
                        <td><img src="{{asset('/images/be.jpg')}}" width="100" height="auto"></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>2</td>
                        <td><img src="{{asset('/images/bee.jpg')}}" width="100" height="auto"></td>
                    </tr>
                </tbody>
            </form>
        </table>
    </div>-->
    <div class="container-fluid" id="start_div">

        <form class="form-inline" id="upload_form" onsubmit = "sendFiles(event)"enctype="multipart/form-data" method="post" action="{{url('/gallery_upload')}}">
             {{ csrf_field() }}
            <input type="file" id="fileElem" multiple accept="image/*"
                name= "photo[]"
                required
                class="form-group btn btn-default"
                 onchange="handleFiles(this.files)"
                 style="display:none";
                >

            
            <label for="fileElem" class = "w3-btn w3-margin-left">Select Image(s)</label>
            <input type="submit" value="upload" class="form-group w3-btn w3-blue" id="form_upload_button">
        </form>@if($errors->has('photo')) {{$errors->all()}}@endif

       
            <!-- Form for Deleting Galleries -->
            <form id="delete_gallery" method="post" action="{{url('/delete_gallery')}}">
                <!--<a href = "#" class = "w3-btn">Add</a>-->
                {{ csrf_field() }}
                

                <div class="row">
                    <div class="col-md-3"><!--start-of-first-outer-col-->
                        <div class="w3-card-3 w3-padding">
                            <span>(Image should not be more than 5MB) Click on Image to remove it</span>
                            <header class="w3-black w3-padding">
                                <h3>Image Preview</h3>
                                
                            </header>
                            <section>
                                <div class="row w3-padding" id="preview">

                                    <div class="alert alert-success">No Image Selected</div>
                                </div>
                                
                            </section>
                        </div>
                    </div><!--end-of-first-outer-col-->

                        <input type="submit" class="w3-btn w3-margin-left" value="Delete Selected Images">
                        <span class="glyphicon glyphicon-trash"></span>

                    <div class="col-md-9"><!--start-of-second-outer-col-->
                        <div class="row" id="gallery_view"><!--start-of-inner-row-->
                       
                        @foreach($user->galleries as $gallery)
                        
                                <div class="col-md-4">                                
                                    <div class="w3-card">                           
                                        <img src= "{{$path}}/{{$gallery->image_name}}" width="100%" height="190"/>
                                        <p class="w3-margin ">
                                            
                                            @if($gallery->caption !== null)
                                                {{$gallery->caption}}
                                            @endif
                                        </p>
                                        <div id="details" class="w3-container w3-teel w3-margin">
                                            <input type="checkbox" value="{{$gallery->image_name}}" class="w3-check" name="images[]"/>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                               <!-- <div class="col-md-4">
                                    <div class="w3-card">
                                        <img src="{{asset('storage/images/bee.jpg')}}" width="100%">
                                        <div id="details" class="w3-container w3-teel w3-margin">
                                                <p>Details Goes here</p>
                                                <input type="checkbox" value = "bee.jpg" class="w3-check" name="images[]"/>
                                        </div>
                                    </div>
                                </div>-->
                        </div><!--end-of-inner-row-->
                    </div><!--end-of-second-outer-col-->
                </div><!--end-of-outer-row-->
            </form><!-- End of form for deleting galleries-->
        @if($user->galleries()->count() == 0)

            <div class="alert alert-success" id="alert">No Galleries Available</div>

        @endif
    </div>

@endsection

@section('js')
<script src="{{asset('/js/combox.js')}}"></script>
@endsection