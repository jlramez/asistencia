@section('title', __('Reports'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
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
                                    <th>No. Retardos</th>
                                    <th>No. Faltas</th>
                                    <th>Periodo</th>                              
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($array as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> 
                                    <td>{{ $row['emp_id'] ?? 'no hay dato'}}</td>
                                    <td>{{ $row['name'] ?? 'no hay dato'}}</td>
                                    <td>{{ $row['delays'] ?? 'no hay dato'}}</td>
                                    <td>{{ floor($row['absences']) ?? 'no hay dato'}}</td>
                                    <td>{{ $row['period'] ?? 'no hay dato'}}</td>
                                </tr>
                                
                                @empty
                                <tr>
                                    <td class="text-center" colspan="100%">No data Found </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>						
                        <div class="float-end"> </div>
                        </div>
                    </div>              
                </div>
			</div>
		</div>
	</div>
</div>
