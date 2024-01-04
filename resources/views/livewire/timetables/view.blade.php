@section('title', __('Timetables'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fa-solid fa-calendar-check"></i>
							Registro de checado </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar #Empleado ...">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Timetables
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.timetables.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Users Id</th>
								<th>Empleado</th>
								<th>Fecha</th>
								<th>Entrada</th>
								<th>Salida</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@forelse($timetables as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->users_id }}</td>
								<td>{{ $row->employees->name ?? 'no hay dato'}}</td>
								<td>{{ $row->date }}</td>
								<td>{{ $row->in_time }}</td>
								<td>{{ $row->out_time }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Timetable id {{$row->id}}? \nDeleted Timetables cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a></li>  
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
					<div class="float-end">{{ $timetables->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>