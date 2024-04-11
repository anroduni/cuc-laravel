
<div class="panel-body">

      @if(Session::has('message'))
        <div class="alert alert-primary" role="alert">
          {{ Session::get('message') }}
        </div>
      @endif 
               
        <p class="h5">Nombre:</p>
        <p class="h6 mb-3">{{ $productos->nombre }}</p>

        <p class="h5">Precio:</p>
        <p class="h6 mb-3">{{ $productos->precio }}</p>

        <p class="h5">Stock:</p>
        <p class="h6 mb-3">{{ $productos->stock }}</p> 

        <p class="h5">Imagen:</p>
        <img src="../../../uploads/{{ $productos->img }}" class="img-fluid" width="20%">                    

</div>

