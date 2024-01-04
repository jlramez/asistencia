@section('title', __('Reports'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
            <div class="row" >
                <div class="col-sm-8">
                    &nbsp;
                </div>
                    <div class="col-sm-4">
                    <p class="alert alert-info">
                        Debe de selecionar los 3 campos  múltiples para que su busqueda tenga algun resultado.
                    </p>
                </div>
            </div>
			<div class="card">
                
				<div class="card-header">
                    <div class="row" >
                      <h4><i class="fa-solid fa-book"></i>  Reporte de incidencias de asistencia del Tribunal de Justicia Laboral Burócratica de Zacatecas</h4>
                    </div>      
				</div>
				
				<div class="card-body">
						@include('livewire.schedules.modals')
                        <div class="row" >
                            <div class="form-group col-sm-6">
                                <label for="Tipo de información">Fecha inicial</label>
                                <input wire:model="fecha_inicial" type="date" class="form-control" id="fecha_inicial" placeholder="Fecha inicial">@error('fecha_inicial') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Tipo de información">Fecha final</label>
                                <input wire:model="fecha_final" type="date" class="form-control" id="fecha_final" placeholder="Fecha final">@error('fecha_final') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mt-4" >
                            <div class="form-group ">
                                <div>
                                    <label for="Unidades" >Empleados / Todos</label>
                                </div> 
                    <div class="input-group-prepend"> 
                                <select  wire:model="users_id" name="users_id" id="users_id" class="form-control">
                                        <option value="" selected>--Seleccione una opción--</option>
                                        <option value="todos" selected>Todos(as)</option>    
                                        @foreach ($employees as $row) 
                                        <option  value="{{ $row->id }}"> {{  $row->name }}</option>
                                        @endforeach
                                    </select>
                    </div> 
                </div> 
                          
                        </div>					
				</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="timetable">
                            <thead class="thead">
                                <tr> 
                                    <td>#</td> 
                                    <th># Empleado</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>                              
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
                                <tr>
                                    <td colspan="6"><h4> No. de retardos: <h4></td><td> <h4>{{$retardos}}</h4></td>
                                </tr>
                            </tbody>
                        </table>						
                        <div class="float-end"> {{ $timetables->links()}}</div>
                        </div>
                    </div>              
            </div>
			</div>
		</div>
	</div>
</div>
