@extends('template')
@section('content')
    <form action="{{ route('kata.store') }}" method="POST">
        @csrf
        <input type="text" name="kruna_andap" placeholder="Masukkan Kruna Andap">
        <input type="text" name="kruna_asi" placeholder="Masukkan Kruna Asi">
        <input type="text" name="kruna_aso" placeholder="Masukkan Kruna Aso">
        <input type="text" name="kruna_ami" placeholder="Masukkan Kruna Ami">
        <input type="text" name="kruna_mider" placeholder="Masukkan Kruna Mider">
        <input type="text" name="kruna_kasar" placeholder="Masukkan Kruna Kasar">
        <input type="text" name="bahasa_indonesia" placeholder="Masukkan Bahasa Indonesia">
        <button type="submit">Submit</button> 
    </form>
@section