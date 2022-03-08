@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    init();
    function init() {
        $('.autocomplete_off').attr('autocomplete', 'off');
    }
    $(document.body).on('click', '.editEmergencyContact', function () {
        $contact_id = $(this).siblings('.contact_id').val();
        $('#editemergencyContact').attr('action', '/admin/emergencyContacts/' + $contact_id);
        $.get('/admin/emergencyContacts/' + $contact_id + '/edit', function (data) {
            $('.edit_name').val(data['name']);
            $('.edit_relationship').val(data['relationship']);
            $('.edit_home_tel').val(data['home_tel']);
            $('.edit_mobile').val(data['mobile']);
            $('.edit_work_tel').val(data['work_tel']);
        });
    });

    $("#ContactForm :input").attr("disabled", true);
    var contactForm = $("#ContactForm");
    $('#editContact').click(function (event) {
        //event.preventDefault();
        contactForm.find(':disabled').each(function () {
            $(this).removeAttr('disabled');
            $('#saveContact').show();
            $('#cancelContact').show();
            $('#editContact').hide();
        });
    });

    $('#cancelContact').click(function (event) {
        //event.preventDefault();
        contactForm.find(':enabled').each(function () {
            $(this).attr("disabled", "disabled");
            $('#saveContact').hide();
            $('#cancelContact').hide();
            $('#editContact').show();
        });
    });

    $('#modalSmall').on('hidden.bs.modal', function () {
        location.reload();
    });

    $("#btn").click(function () {

        $("#holiday").validate({
            excluded: ':disabled',
            rules: {
                event_name: {
                    required: true
                },
                description: {
                    required: true
                },

                start_date: {
                    required: true
                },
                end_date: {
                    greaterThanDate: "#start_date"
                }

            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block animated fadeInDown',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        })
    });
    $(document.body).on('change', '#parent_present', function () {
        if (this.checked) {
            $('.child_present').prop('checked', true)
        } else {
            $('.child_present').prop('checked', false);
        }
    });
    jQuery.validator.addMethod("greaterThanDate",
        function (value, element, params) {


            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) >= new Date($(params).val());
            }

            return Number(value) >= Number($(params).val());
        }, 'End Date Must be greater than Start Date.');

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
    $("#btn").click(function () {

        $("#personalAttach").validate({
            excluded: ':disabled',
            rules: {

                description: {
                    required: true
                },
                file: {
                    required: true
                },



            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block animated fadeInDown',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        })
    });

    
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Employee <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Contact Details</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-3">
            @include('admin.employees.sidebar')
        </div>
        <div class="col-lg-9 col-md-9 col-xs-9">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Contact Details</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('contactDetails.store') }}" id="ContactForm" class="ContactForm" method="post"
                        accept-charset="utf-8">
                        @csrf
                        <div class="box-body">



                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Address Street 1<span class="required">*</span></label>
                                        <input type="text" name="address_1" class="form-control autocomplete_off" value="{{ $contactDetail->street1 }}"
                                            disabled="disabled" required>
                                    </div>


                                    <div class="form-group">
                                        <label>City <span class="required">*</span></label>
                                        <input type="text" name="city" class="form-control autocomplete_off" value="{{ $contactDetail->city }}"
                                            disabled="disabled" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Zip/Postal Code<span class="required">*</span></label>
                                        <input type="text" name="postal" class="form-control autocomplete_off" value="{{ $contactDetail->zip }}"
                                            disabled="disabled">
                                    </div>


                                    <div class="form-group">
                                        <label>Home Telephone <span class="required">*</span></label>
                                        <input type="text" name="home_telephone" class="form-control autocomplete_off"
                                            value="{{ $contactDetail->home_tel }}" disabled="disabled" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Work Telephone</label>
                                        <input type="text" name="work_telephone" class="form-control autocomplete_off"
                                            value="{{ $contactDetail->work_tel }}" disabled="disabled">
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" name="mobile" class="form-control autocomplete_off" value="{{ $contactDetail->mobile }}"
                                            disabled="disabled">
                                    </div>

                                    <span class="required">*</span>Required field
                                </div>



                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Address Street 2</label>
                                        <input type="text" name="address_2" class="form-control autocomplete_off" value="{{$contactDetail->street2}}"
                                            disabled="disabled">
                                    </div>

                                    <div class="form-group">
                                        <label>State/Province<span class="required">*</span></label>
                                        <input type="text" name="state" class="form-control autocomplete_off" value="{{$contactDetail->state}}"
                                            disabled="disabled" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Country <span class="required">*</span></label>
                                        <select class="form-control ls-select2" name="country" disabled="disabled" style="width:100%"
                                            required>
                                            {{-- <option value="{{ $contactDetail->country }}" selected>{{$contactDetail->country}}</option>
                                            --}}
                                            <option value="">Please Select...</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Ã…land">Ã…land</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Saint BarthÃ©lemy">Saint BarthÃ©lemy</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bonaire">Bonaire</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                            <option value="Democratic Republic of the Congo">Democratic
                                                Republic of the Congo</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Republic of the Congo">Republic of the Congo</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Ivory Coast">Ivory Coast</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Chile">Chile</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Curacao">Curacao</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Finland">Finland</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Micronesia">Micronesia</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="France">France</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Greece">Greece</option>
                                            <option value="South Georgia and the South Sandwich Islands">South
                                                Georgia and the South Sandwich Islands</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Heard Island and McDonald Islands">Heard Island and
                                                McDonald Islands</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="India">India</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean
                                                Territory</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="North Korea">North Korea</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Saint Martin">Saint Martin</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Myanmar [Burma]">Myanmar [Burma]</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Niue">Niue</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Peru">Peru</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Pitcairn Islands">Pitcairn Islands</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="RÃ©union">RÃ©union</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="South Sudan">South Sudan</option>
                                            <option value="SÃ£o TomÃ© and PrÃ&shy;ncipe">SÃ£o TomÃ© and
                                                PrÃ&shy;ncipe</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Sint Maarten">Sint Maarten</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Chad">Chad</option>
                                            <option value="French Southern Territories">French Southern
                                                Territories</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="East Timor">East Timor</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="U.S. Minor Outlying Islands">U.S. Minor Outlying
                                                Islands</option>
                                            <option value="United States">United States</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vatican City">Vatican City</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and
                                                the Grenadines</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="British Virgin Islands">British Virgin Islands</option>
                                            <option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="Kosovo">Kosovo</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Work Email</label>
                                        <input type="email" name="work_email" class="form-control autocomplete_off"
                                            value="{{ $contactDetail->work_email }}" disabled="disabled">
                                    </div>

                                    <div class="form-group">
                                        <label>Other Email</label>
                                        <input type="email" name="other_email" class="form-control autocomplete_off"
                                            value="{{ $contactDetail->other_email }}" disabled="disabled">
                                    </div>



                                </div>

                            </div>

                            <input type="hidden" name="employee_id" value="{{ $employee->id }}" disabled="disabled">

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a class="btn bg-info btn-flat" id="editContact"><i class="fa fa-pencil-square-o"></i>Edit</a>
                            <button id="saveContact" type="submit" class="btn bg-success btn-flat" style="display:none ;"
                                disabled="disabled">Save</button>&nbsp;&nbsp;&nbsp;
                            <a class="btn bg-danger btn-flat" id="cancelContact" style="display: none;">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Emergency Contact</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <form action="{{ route('emergencyContacts.delete') }}" method="post" accept-charset="utf-8">
                                @csrf
                                <a data-target="#addEmergencyContact" title="View" data-placement="top" data-toggle="modal"
                                    href="#" class="btn bg-info btn-md btn-flat">
                                    <i class="fa fa-plus"></i> Add Emergency </a>

                                <button type="submit" onclick="return confirm('Are you sure want to delete this record ?');"
                                    class="btn btn-danger btn-md btn-flat" id="deletePersonalAttach"><i class="fa fa-trash"></i>
                                    Delete </button>

                                <br>
                                <br>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <!--                                    <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>-->
                                                <th class="active">
                                                    <label class="css-input css-checkbox css-checkbox-danger">
                                                        <input type="checkbox" id="parent_present"><span></span>
                                                    </label>
                                                </th>
                                                <th class="active">Name</th>
                                                <th class="active">Relationship</th>
                                                <th class="active">Home Telephone</th>
                                                <th class="active">Mobile</th>
                                                <th class="active">Work Telephone</th>
                                                <th class="active">Actions</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($emergencyContacts) == 0)
                                            <div class="card text-white bg-info text-sm-center">
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                        <p>Hi, this user don't have any emergency contact yet</p>
                                                    </blockquote>
                                                </div>
                                            </div>
                                            @else
                                            @foreach($emergencyContacts as $contact)
                                            <tr>
                                                
                                                <td>
                                                    <label class="css-input css-checkbox css-checkbox-success">
                                                        <input name="emergencyContact[]" value="{{ $contact->id }}"
                                                            type="checkbox" class="child_present"><span></span>
                                                    </label>
                                                </td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->relationship }}</td>
                                                <td>{{ $contact->home_tel }}</td>
                                                <td>{{ $contact->mobile }}</td>
                                                <td>{{ $contact->work_tel }}</td>
                                                <td>
                                                    
                                                    

                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <input type="hidden" class="contact_id" value="{{ $contact->id }}">
                                                        <button type="button" class="btn btn-icon btn-outline-info editEmergencyContact" data-target="#editEmergencyContactModal" title="View"
                                                        data-placement="top" data-toggle="modal"><i
                                                                class="icon-fa icon-fa-pencil"></i></button>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>

                                    </table>
                                </div>
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addEmergencyContact" style="display: none;">
    @include('admin.emergencyContacts.create')
</div>
<div class="modal fade" id="editEmergencyContactModal" style="display: none;">
    @include('admin.emergencyContacts.edit')
</div>
<div class="modal fade" id="addTerminationModal" style="display: none;">
    @include('admin.employeeTerminations.create')
</div>


@endsection