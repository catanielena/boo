@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Aggiungi il piatto</div>
                <div class="card-body">
					<form action="{{route("admin.foods.update", $food["id"])}}" method="POST" enctype="multipart/form-data" onsubmit="return validateFood()">
						@csrf
            @method("PUT")
            {{-- Inserisci il nome --}}
						<div class="form-group">
						  <label for="name">Nome*</label>
						  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Inserisci il nome" value="{{old("name") ?? $food["name"]}}">
						  @error('name')
							<div class="alert alert-danger">{{ $message }}</div>
						  @enderror
              <small></small>
						</div>
            {{-- Inserisci l'immagine --}}
            <div class="form-group">
              <label for="image">Inserisci l'immagine</label>
              <div>
                <img id="foodEditPreview" style="max-height: 100px;" src="{{$food['image'] != null ? url('storage/' .  $food['image']) : null}}" class="mb-2" alt="{{$food['image'] != null ? $food['name'] : ''}}"/>
              </div>
              <input type="file" class="@error('image') is-invalid @enderror" name="image" id="image" placeholder="Inserisci l'url dell'immagine" value="{{old("image") ?? $food["image"]}}">
              @error('image')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <small></small>
            </div>
            <div id="prova"></div>
            {{-- Inserisci la descrizione --}}
						<div class="form-group">
							<label for="description">Descrizione </label>
							<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" placeholder="Inserisci il contenuto">{{old("description") ?? $food["description"]}}</textarea>
							@error('description')
								<div class="alert alert-danger">{{ $message }}</div>
						    @enderror
                <small></small>
						</div>
            {{-- Allergeni --}}
						<div class="form-group">
							<label for="allergens">Allergeni </label>
							<textarea class="form-control @error('allergens') is-invalid @enderror" name="allergens" id="allergens" cols="30" rows="10" placeholder="Inserisci gli allergeni">{{old("allergens") ?? $food["allergens"]}}</textarea>
							@error('allergens')
								<div class="alert alert-danger">{{ $message }}</div>
						    @enderror
                <small></small>
						</div>
            {{-- Peso --}}
            <div class="form-group">
                <label for="weight">Inserisci il peso in grammi</label>
                <input type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight" placeholder="Inserisci il peso" value="{{old("weight") ?? $food["weight"]}}">
                @error('weight')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <small></small>
            </div>
            {{-- Visibilità --}}
            <div class="form-group">
                <label for="visible">Visibilità del piatto</label>
                <select id="visible" class="form-control" name="visible">
                  <option  value="1" {{(old('visible') ?? $food['visible']) == 1 ? 'selected' : null}}>Visibile</option>
                  <option value="0" {{(old('visible') ?? $food['visible']) == 0 ? 'selected' : null}}>Non visibile</option>
                </select>
            </div>
            {{-- Prezzo --}}
						<div class="form-group">
                <label for="price">Inserisci il prezzo*</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Inserisci il prezzo" value="{{old("price") ?? $food["price"]}}">
                @error('price')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <small></small>
            </div>

						<button type="submit" class="btn btn-warning">Salva modifiche</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection