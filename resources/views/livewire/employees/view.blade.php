@section('title', __('Employees'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-users"></i>
							Listado de empleados </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar empleado ...">
						</div>
						<div class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i> Nuevo empleado
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.employees.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>NoEmp</th>
								<th>Name</th>
								<th>Activo</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@forelse($employees as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->id }}</td>
								<td>{{ $row->name }}</td>
								@if ($row->ssocial=='0')
								<td align="center"><i class="fa-solid fa-xmark text-danger"></i></td>
								@endif
								@if ($row->ssocial=='1')
								<td  align="center"><i class="fa-solid fa-check text-success"></i></td>
								@endif
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Employee id {{$row->id}}? \nDeleted Employees cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a></li>  
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
					<div class="float-end">{{ $employees->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>