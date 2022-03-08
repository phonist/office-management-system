<div class="card">
    <div class="card-header bg-info">
        <div class="caption">
            <h6>{{$employee->l_name}}</h6>
            
        </div>
    </div>
    <div class="card-body">
        <div class="profile-userpic">
            @if($employee->photo != NULL)
            <img src="/employeesPhoto/{{ $employee->photo }}" alt="{{ $employee->photo }}" style="max-width:200px;max-height:200px">
            @else
            <img src="{{asset('/assets/admin/img/avatars/user.png')}}" alt="Avatar" style="max-width:200px;max-height:200px"></a>
            @endif
            
        </div>
        @if($employee->terminate_status == false)
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <b>{{$employee->f_name}} {{$employee->l_name}}</b></div>
            <div class="profile-usertitle-job">
                <b>Employee Id : {{ $employee->id_number }} </b></div>
        </div>
        <br>
        <div class="profile-userbuttons">
            <a data-target="#addTerminationModal" data-placement="top" data-toggle="modal" href="#" class="btn btn-danger btn-sm">
                Termination </a>
        </div>
        @else

        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                {{ $employee->f_name }} {{ $employee->l_name }} </div>
            <div class="profile-usertitle-job">
                Employee Id : <strong style="color: RED">Terminated</strong>
            </div>

        </div>
        <br>
        <div class="profile-userbuttons">
            <form action="{{ route('employeeTerminations.unterminate',\App\EmployeeTermination::where('employee_id',$employee->id)->first()->id) }}" method="post"
                accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure to Re Join Employment ?');" class="btn bg-navy btn-sm">Re
                    Join Employment </button>
            </form>
        </div>
        <br>
        <a href="{{ route('employeeTerminations.show',\App\EmployeeTermination::where('employee_id',$employee->id)->first()->id) }}"
            class="btn btn-block btn-flat bg-maroon text-left">Termination Note</a>
        @endif
    </div>
    <div class="card-body">
        <div class="tabs tabs-simple tabs-vertical">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                        <a href="{{ route('employees.show',$employee->id) }}">Personal
                                Details</a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('employees.contactDetails',$employee->id) }}">Contact
                                Details</a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('employees.employeeDependents',$employee->id) }}">Dependents</a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('employees.employeeCommencements',$employee->id) }}">Job</a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('employees.employeeSalaries',$employee->id) }}">Salary</a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('employees.reportTo',$employee->id) }}">Report-to</a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('employees.directDeposit',$employee->id) }}">Direct
                                Deposit</a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('employees.employeeLogin',$employee->id) }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</div>
