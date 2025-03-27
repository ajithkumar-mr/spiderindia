@extends('layouts.app')

<style>
    .error {
        color: red;
        font-size: 14px;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h4 class="text-center text-danger"><b>Manage Time Table</b></h4>
        <br><br><br>

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.<br><br>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        @if ($message = Session::get('danger'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card" style="box-shadow: 0px -1px 13px 3px dimgray;">
                    <div class="card-body">
                    <form action="#" method="post" id="payment-form">
                        <label><b>Select class</b></label><br>
                        <select class="form-control classes" name="classes" id="classes" required>
                        <option disabled selected value=""> Select Class </option>
                        @foreach($time_tables as $time_table)
                        <option value="{{ $time_table->clas }}">{{ $time_table->clas }}</option>
                        @endforeach
                        </select>
                        <span id="error-classes" class="error"></span> <br><br>
                        <button class="btn btn-success col-md-2" id="save">Manage</button>
                    </form> 
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="box-shadow: 0px -1px 13px 3px dimgray;">
                    <h4 class="text-center text-white" style="background: #04354d;padding: 6px 0px 6px 0px;border-radius: 4px;"><b>Create Time Table</b></h4>
                    <div class="card-body">
                        <form action="{{ route('create') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label><b>Enter Class</b><span class="text-danger">*</span></label>
                                    <input  class="form-control clas" type="text" id="clas" name="clas" placeholder="Enter Class" required>
                                </div>
                                <div class="col-md-6">
                                    <label><b>No. of days</b><span class="text-danger">*</span></label>
                                    <input  class="form-control no_of_days" type="number" id="no_of_days" name="no_of_days" placeholder="No. of days" required>
                                </div>
                                <br><br><br><br>
                                <div class="col-md-6">
                                    <label><b>No. of period</b><span class="text-danger">*</span></label>
                                    <input  class="form-control no_of_period" type="number" id="no_of_period" name="no_of_period" placeholder="No. of period" required>
                                </div>
                                <div class="col-md-6">
                                    <label><b>Time</b><span class="text-danger">*</span></label>
                                    <input  class="form-control time" type="time" id="clas_time" name="clas_time" required>
                                </div>
                                <br><br><br><br>
                                <div class="col-md-6">
                                    <label><b>Duration of each class ( in Miniutes )</b><span class="text-danger">*</span></label>
                                    <input  class="form-control duration_class" type="text" id="duration_class" name="duration_class" placeholder="Duration of each class ( in Miniutes )" required>
                                </div>
                                <div class="col-md-6">
                                    <label><b>No of Breaks</b><span class="text-danger">*</span></label>
                                    <select class="form-control no_of_breaks" name="no_of_breaks" id="no_of_breaks" required>
                                        <option disabled selected value=""> Select No of Breaks </option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 break1">
                                    <label>Break 1:after the period of</label>
                                    <input  class="form-control period_break1" type="text" id="period_break1" name="period_break1">
                                </div>
                                <div class="col-md-6 break1">
                                    <label>Duration of this break(in mins)</label>
                                    <input  class="form-control duration_break1" type="text" id="duration_break1" name="duration_break1">
                                </div>
                                <div class="col-md-6 break2">
                                    <label>Break 2:after the period of</label>
                                    <input  class="form-control period_break2" type="text" id="period_break2" name="period_break2">
                                </div>
                                <div class="col-md-6 break2">
                                    <label>Duration of this break(in mins)</label>
                                    <input  class="form-control duration_break2" type="text" id="duration_break2" name="duration_break2">
                                </div>                              
                                <div class="col-md-6 break3">
                                    <label>Break 3:after the period of</label>
                                    <input  class="form-control period_break3" type="text" id="period_break3" name="period_break3">
                                </div>
                                <div class="col-md-6 break3">
                                    <label>Duration of this break(in mins)</label>
                                    <input  class="form-control duration_break3" type="text" id="duration_break3" name="duration_break3">
                                </div>
                               <br>
                            </div>
                            <button type="submit" class="btn btn-primary text-white text-center col-md-2 mt-5" style="margin-left: 255px;">SUBMIT</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(".break1").hide();
        $(".break2").hide();
        $(".break3").hide();

        $(document).on('change', "#no_of_breaks", function() {
        let noofbreaks = $(this).val();
        if(noofbreaks === '1'){
            $(".break1").show();
            $(".break2").hide();
            $(".break3").hide();
        }else if(noofbreaks === '2'){
            $(".break1").show();
            $(".break2").show();
            $(".break3").hide();
        }else if(noofbreaks === '3'){
            $(".break1").show();
            $(".break2").show();
            $(".break3").show();
        }
    });

    $(document).on('click', "#save", function() {
        event.preventDefault();
        let classes = $("#classes").val();
        if(classes !==''){
            $("#error-classes").text("");
        $.ajax({
                url: '/schedule',
                method: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    classes: classes,
                },
                success: function(data) {
                    if(data){
                        $('#clas').val(data.clas);
                        $('#no_of_days').val(data.no_of_days);
                        $('#no_of_period').val(data.no_of_period);
                        $('#clas_time').val(data.clas_time);
                        $('#duration_class').val(data.duration_class);
                        $('#no_of_breaks').val(data.no_of_breaks);
                        $('#period_break1').val(data.period_break1);
                        $('#duration_break1').val(data.duration_break1);
                        $('#period_break2').val(data.period_break2);
                        $('#duration_break2').val(data.duration_break2);
                        $('#period_break3').val(data.period_break3);
                        $('#duration_break3').val(data.duration_break3);

                        let period_break1 = $('#period_break1').val();
                        let period_break2 = $('#period_break2').val();
                        let period_break3 = $('#period_break3').val();
                        if(period_break1){
                            $(".break1").show();
                        }else{
                            $(".break1").hide();
                        }
                        if(period_break2){
                            $(".break2").show();
                        }else{
                            $(".break2").hide();
                        }
                        if(period_break3){
                            $(".break3").show();
                        }else{
                            $(".break3").hide();
                        }
                    console.log(data.clas);
                    }else{
                        alert('No Data Found');
                    }
                },
                error: function(error) {
                    console.error('Error fetching unique roles:', error);
                }
            });
        }else{
            $("#error-classes").text("This field is required.");
        }
    });
});

</script>
@endsection
