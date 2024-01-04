@section('title', __('Checks'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fa-solid fa-square-check"></i>
							Listado de registros </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar registros ...">
						</div>
						<div>
							<a class="btn btn-sm btn-warning" wire:click="calcule_date()">
								<i class="fa fa-calendar"></i>  calcular fecha
							</a>
							<a class="btn btn-sm btn-info" wire:click="divide()">
								<i class="fa fa-cut"></i>  Separar entradas
							</a>
							<a class="btn btn-sm btn-danger" wire:click="divide_out()">
								<i class="fa fa-cut"></i>  Separar salidas
							</a>
							<a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createDataModal" align="rigth">
								<i class="fa fa-plus"></i>  Nuevo registro
							</a>
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.checks.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th># Empleado</th>
								<th>Empleado</th>
								<th>Registros</th>
								<th>Fecha</th>
								<th>Tipo</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@forelse($checks as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->users_id }}</td>
								<td>{{ $row->employees->name ?? 'No disponible' }}</td>
								<td>{{ $row->checktime }}</td>
								<td>{{ $row->date }}</td>
								<td>{{ $row->types_id }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Check id {{$row->id}}? \nDeleted Checks cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a></li>  
										</ul>
									</div>								
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					<div class="float-end">{{ $checks->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>