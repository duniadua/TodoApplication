@extends('template.master')
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
@section('title','Application')
@include('errors.common')

@section('content')

{!! Form::open(array('action' => array('TodoController@update', $result->id),'method' =>'PUT')) !!}
<div class="col-lg-6">    
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $result->title }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ $result->description }}">
    </div>       
    {!! Form::submit('Submit',array('class' => 'btn btn-default')) !!}
    {!! link_to_action('TodoController@index','New Record','',['class' => 'btn btn-default'] ) !!}
</div>
{!! Form::close() !!}
<div class="col-lg-6">
    <table class="table">
        <thead>
            <tr><th>#</th><th>Title</th> <th>Description</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($todos as $todo)
            <tr>
                <td><?php echo $i++; ?></td>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>
                    {!! link_to_action('TodoController@show','Show',$todo->id ,['class' => 'btn btn-default'] ) !!}                    
                    {!! Form::open(['action' => ['TodoController@destroy', $todo->id], 'method' => 'delete']) !!}
                    {!! Form::submit('Deletes', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



