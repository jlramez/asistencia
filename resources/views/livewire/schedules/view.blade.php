@section('title', __('Schedules'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-clock"></i>
							Listado de horarios </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar horario ...">
						</div>
						<div class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Crear horario
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.schedules.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Descripcion</th>
								<th>Entrada</th>
								<th>Salida</th>
								<th>Tolerancia</th>
								<th>Active</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@forelse($schedules as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->descripcion }}</td>
								<td>{{ $row->on }}</td>
								<td>{{ $row->out }}</td>
								<td>{{ $row->tolerance }}</td>
								@if ($row->active=='0')
								<td align="center"><i class="fa-solid fa-xmark text-danger"></i></td>
								@endif
								@if ($row->active=='1')
								<td  align="center"><i class="fa-solid fa-check text-success"></i></td>
								@endif
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Schedule id {{$row->id}}? \nDeleted Schedules cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a></li>  
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
					<div class="float-end">{{ $schedules->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>