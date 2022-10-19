<b>Id</b>:
{{ $priceList->id }}
<br>
<b>Material</b>:
{{ $priceList->Material->mate_descripcion }}
<br>
<b>Obra</b>:
{{ $priceList->Construction->obra_nombre }}
<br>
<b>Precio</b>:
{{ $priceList->precio }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
