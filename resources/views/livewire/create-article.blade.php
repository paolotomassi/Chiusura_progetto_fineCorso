<div>

    <div class="container-fluid py-3 sfondoCus">
        <div class="row justify-content-center">
            <div class="col-8 txt-secondary fw-bold">
                <form enctype="multipart/form-data" wire:submit="save">
                    <div class="mb-3">
                        <label class="form-label">Titolo:</label>
                        <input type="text" class="form-control" @error('title') is-invalid @enderror
                            wire:model.blur='title' value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
    
                        <div class="mb-3">
                            <label  class="form-label">Sottotitolo:</label>
                            <input type="text" class="form-control" @error('subtitle') is-invalid @enderror wire:model.blur='subtitle' value="{{old('subtitle')}}">
                            @error('subtitle')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            </div>
                          
    
                          <div class="mb-3">
                            <label  class="form-label">Prezzo:</label>
                            <input type="number" class="form-control" @error('price') is-invalid @enderror wire:model.blur='price' value="{{old('price')}}">
                            @error('price')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                          </div>
                          <div >
                          <label class="form-label"> Descrizione Articolo</label>
                          <textarea wire:model.blur="body"  cols="30" rows="10" class="form-control" @error('body') is-invalid @enderror>{{old('body')}}</textarea>
                          @error('body')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="input-group my-3">
                          <label class="input-group-text txt-secondary bg-main fwbtnFormCus">Categorie</label>
                          <select class="form-select"  @error('category') is-invalid @enderror wire:model.blur="category">
                            @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach



                        </select>
                    </div>

                    <div class="mb-3">
                            <div class="mb-3">
                              <input wire:model="temporary_images" type="file" name="images" multiple class="form-control shadow  @error('temporary_images') is-invalid @enderror" placeholder="Img">
                              @error('temporary_images')
                              <div class="alert alert-danger">{{$message}}</div>
                              @enderror
                            </div>
                            @if (!@empty($images))
                            <div class="row">
                          <div class="col-12">
                            <p>Immagini Preview:</p>
                            <div class="row border border-4 border-info rounded shadow py-4">
                              @foreach ($images as $key => $image)
                              <div class="col my-3">
                                <div class="img-preview mx-auto shadow rounded " style="background-image: url({{ $image->temporaryUrl() }});"></div>
                                <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto" wire:click="removeImage({{$key}})">Cancella</button>
                              </div>
                              @endforeach
                            </div>
                          </div>
                            </div>
                            @endif
                          </select>
                        </div>
                    <button type="submit" class="btn btnFormCus fw-bold">Crea Articolo</button>
                </form>
            </div>
        </div>
        <x-footer />
    </div>
</div>
