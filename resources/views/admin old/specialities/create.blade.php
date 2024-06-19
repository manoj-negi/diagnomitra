
@extends('layouts.adminCommon')
@section('content')
<div class="container">
    <div class="row justify-content">
        <div class="col-12 pt-5 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <form action="{{route('specialities.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$result->id ?? ''}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', isset($result) && isset($result->name) ? $result->name : '') }}" placeholder="Title" required />
                                </div>
                                @error('name')
                                <div class="validationclass text-danger pt-2">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Spenish Title <span class="text-danger">*</span></label>
                                    <input type="text" name="spenish_name" class="form-control" value="{{ old('spenish_name', isset($result) && isset($result->spenish_name) ? $result->spenish_name : '') }}" placeholder="Title"  />
                                </div>
                                @error('spenish_name')
                                <div class="validationclass text-danger pt-2">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Description</label>
                                    <textarea  name="description" class="form-control" row="2" placeholder="Description">{{ old('description', isset($result) && isset($result->description) ? $result->description : '') }}</textarea>
    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Spenish Description</label>
                                    <textarea  name="spenish_description" class="form-control" row="2" placeholder="Description">{{ old('spenish_description', isset($result) && isset($result->spenish_description) ? $result->spenish_description : '') }}</textarea>
    
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" {{isset($result) && $result->status=="1"?'selected':''}}>Active
                                        </option>
                                        <option value="0" {{isset($result) && $result->status=="0"?'selected':''}}>De-Active
                                        </option>
                                    </select>
                                </div> 
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm">Back</a>
                                <button type="submit" value="submit" class="btn btn-primary btn-sm">Submit</button>
                           
                            </div>
                        </div>
                    </form>
                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
