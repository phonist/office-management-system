@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
init();
function init(){
    $('.autocomplete_off').attr('autocomplete','off');  
}
$(document.body).on('change', '#parentAttendanceCheckbox', function () {
    if (this.checked) {
        $('.child_present').prop('checked', true)
    } else {
        $('.child_present').prop('checked', false);
    }
});

$(document.body).on('change', '#parentLeaveCheckbox', function () {
    if (this.checked) {
        $('.child_absent').prop('checked', true)
    } else {
        $('.child_absent').prop('checked', false)
    }
});  

$('.showYear').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
});
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Attendance <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('client.index') }}">Attendance</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Attendance Report</h6>
                    </div>
                    
                </div>
                <div class="card-body">
                        <form action="{{ route('profiles.setAttendanceYear',$id) }}" class="form-horizontal" method="post"
                        accept-charset="utf-8">
                        @csrf
                        <div class="panel_controls">
                            <div class="form-group margin">
                                <label class="col-sm-3 control-label">Year <span class="required">*</span></label>

                                <div class="col-sm-5">
                                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="icon-fa icon-fa-calendar"></i>
                                            </span>
                                        </div>
                                    <input type="text" name="date" class="form-control ls-datepicker autocomplete_off showYear" value="{{ $year }}" data-date-format="yyyy-mm-dd" required>
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn bg-olive btn-md btn-flat">Go</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            @if($attendances != null)
             <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>{{ Auth::user()->name }} </h6>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th class="active">Months in {{ $year }}</th>

                                @for($i = 1; $i<=31;$i++ ) <th class="active ">{{$i}}</th>
                                @endfor

                            </tr>

                        </thead>

                        <tbody>
                            
                            
                            <tr>
                                <td>  January  </td>
                               @for($i=1;$i<=$month[0];$i++)
                               <td>
                                    @foreach($attendances as $attendance)
                                        @if($attendance->date == $year.'-01-'.$i)
                                        <small class="label btn-default">On Duty</small>
                                        @endif
                                    @endforeach
                               </td>
                               @endfor
                            </tr>
                            <tr>
                                <td>  February  </td>
                                @for($i=1;$i<=$month[1];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-02-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  March  </td>
                                @for($i=1;$i<=$month[2];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-03-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                               @endfor
                            </tr>
                            <tr>
                                <td>  April  </td>
                                @for($i=1;$i<=$month[3];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-04-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                               @endfor
                            </tr>
                            <tr>
                                <td>  May  </td>
                                @for($i=1;$i<=$month[4];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-05-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  June  </td>
                                @for($i=1;$i<=$month[5];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-06-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  July  </td>
                                @for($i=1;$i<=$month[6];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-07-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  August  </td>
                                @for($i=1;$i<=$month[7];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-08-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  September  </td>
                                @for($i=1;$i<=$month[8];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-09-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  October  </td>
                                @for($i=1;$i<=$month[9];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-10-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  November  </td>
                                @for($i=1;$i<=$month[10];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-11-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            <tr>
                                <td>  December  </td>
                                @for($i=1;$i<=$month[11];$i++)
                                <td>
                                        @foreach($attendances as $attendance)
                                            @if($attendance->date == $year.'-12-'.$i)
                                            <small class="label btn-default">On Duty</small>
                                            @endif
                                        @endforeach
                                   </td>
                                @endfor
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
           
        </div>
    </div>
</div>
@endsection