@extends('layouts.master')
@section('title') BikeShop | แก้ไขข้อมูลสินค้า@stop
@section('content')

<h1>แก้ไขข้อมูลสินค้า</h1>
<ul class="breadcrumb">
    <li><a href="{{URL::to('product')}}">หน้าแรก</a></li>
    <li class="active">แก้ไขสินค้า</li>

</ul>
{!! Form::model($product, array('method' => 'post','enctype' => 'multipart/form-data','action' => 'ProductController@update')) !!}
    <input type="hidden" name="id" value="{{$product->id}}">
    <div class="panel panel-default">

        <div class="panel panel-heading">
            @if($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach 
            </div>
            @endif
            {!! Form::model($product,array('action' => 'ProductController@update','method' => 'post','enctype' => 'multipart/form-data')) !!}
            <strong>ข้อมูลสินค้า</strong>
        </div>
    </div>
    <div class="panel-body">
    
        <table>
            <tr>
                <td>{{ Form::label('code','รหัสสินค้า')}}</td>
                <td>{{ Form::text('code' , Input::old('code') , ['class' => 'form-control']) }}</td>
            </tr>

            <tr>
                <td>{{ Form::label('name','ชื่อสินค้า')}}</td>
                <td>{{ Form::text('name' , Input::old('name') , ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
            <td>{{ Form::label('category_id','ประเภทสินค้า')}}</td>
            <td>{{Form::select('category_id',$categories,Input::old('category_id'))}}</td>
            </tr>
            <tr>
                <td>{{ Form::label('stock_qty','คงเหลือ')}}</td>
                <td>{{ Form::text('stock_qty' , Input::old('stock_qty') , ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
                <td>{{ Form::label('price','ราคา')}}</td>
                <td>{{ Form::text('price' , Input::old('price') , ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
                <td>{{ Form::label('image','เลือกรูปภาพ')}}</td>
                <td>{{ Form::file('image' , Input::old('image') , ['class' => 'form-control']) }}</td>
            </tr>
            @if($product->image_url)
            <tr>
                <td><strong>รูปสินค้า</strong></td>
            <td><img src="{{URL::to($product->image_url)}}" alt="" width="100px"></td>
            </tr>
            @endif
        </table>
    </div>
    <div class="panel-footer">
     <button type="reset" class="btn btn-danger">ยกเลิก</button>
     <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>บันทึก</button>
    </div>
{!! Form::close() !!}
@endsection