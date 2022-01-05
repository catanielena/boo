@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Aggiungi il piatto</div>
                  <div class="card-body">
                    <form action="{{route("admin.foods.store")}}" method="POST" enctype="multipart/form-data" name="createFoodForm" onsubmit="return validateFood()">
                      @csrf
                      {{-- Inserisci il nome --}}
                      <div class="form-group">
                        <label for="name">Nome*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Inserisci il nome" value="{{old("name")}}" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small></small>
                      </div>
                      {{-- Inserisci l'immagine --}}
                      <div class="form-group">
                        <label for="image" >Inserisci l'immagine</label>
                        <div>
                          <img id="foodCreatePreview" style="max-height: 100px;"  class="mb-2"/>
                        </div>
                        <input type="file" class="@error('image') is-invalid @enderror" name="image" id="image" value="{{old("image")}}">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small></small>
                      </div>
                      {{-- Inserisci la descrizione --}}
                      <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" placeholder="Inserisci il contenuto">{{old("description")}}</textarea>
                        @error('description')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small></small>
                      </div>
                      {{-- Allergeni --}}
                      <div class="form-group">
                        <label for="allergens">Allergeni</label>
                        <textarea class="form-control @error('allergens') is-invalid @enderror" name="allergens" id="allergens" cols="30" rows="10" placeholder="Inserisci gli allergeni">{{old("allergens")}}</textarea>
                        @error('allergens')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small></small>
                      </div>
                      {{-- Peso --}}
                      <div class="form-group">
                        <label for="weight">Inserisci il peso in grammi</label>
                        <input type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight" placeholder="Inserisci il peso" value="{{old("weight")}}">
                        @error('weight')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small></small>
                      </div>
                      {{-- Visibilità --}}
                      <div class="form-group">
                        <label for="visible">Visibilità del piatto</label>
                        <select id="visible" class="form-control" name="visible">
                          <option value="1" selected>Visibile</option>
                          <option value="0">Non visibile</option>
                        </select>
                      </div>
                      {{-- Prezzo --}}
                      <div class="form-group">
                        <label for="price">Inserisci il prezzo*</label>
                        <input lang="it" type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Inserisci il prezzo" value="{{old("price")}}" required>
                        @error('price')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small></small>
                      </div>
                      <button type="submit" class="btn btn-yellow" id="btn-submit">Crea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection