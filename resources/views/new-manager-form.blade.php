@extends('adminLayout')

@section('content')

    <!-- form div -->
    <div class="col-lg-6 pr-xl-5">
        <div class=" card card-dark " style="background-color: silver ">
        <x-form.header-card title="إضافة مدير جديد"/>

            <form action="/store-manager" method="Post">
                <div class="card-body fc-direction-rtl">
                    @csrf


                    <x-form.input name="man_frist_name" class="form-control" type="name" value="man_frist_name"
                                  label="الاسم الأول" placeholder="أدخل الأسم الأول للمدير الجديد" />

                    <x-form.input name="man_last_name" class="form-control" type="name"
                                  label="الاسم الأخير" placeholder="أدخل اسم الأخير للمدير الجديد" />

                    <x-form.input name="man_phone_num" class="form-control" type="tel"
                                  label="رقم الجوال" placeholder="أدخل رقم الجوال التابع للمدير الجديد" />

                    <x-form.input name="man_email" class="form-control" type="email"
                                  label="البريد الإلكتروني" placeholder="أدخل البريد الإلكتروني التابع للمدير الجديد" />

                    <div class="form-group col-sm-10 ">
                        <label>المنصب</label>
                        <select  name="pos_id" id="pos_id" onchange="GetSelectedItem">
                            @foreach($positions as $position)
                                <option value="{{$position->pos_id}}"> {{$position->pos_name}} </option>
                            @endforeach
                        </select>
                    </div>

                    <script>
                        function GetSelectedItem(pos_id)
                        {
                            var option = document.getElementById(pos_id);
                            var selectedop = option.options[option.selectedIndex].text;
                        }
                    </script>

                    <x-form.input name="man_password" class="form-control" type="password"
                                  label="كلمة المرور" placeholder="أدخل كلمة المرور التابعة للمدير الجديد" />

                    <x-form.cancel-button indexPage="manager"/>
                    <x-form.save-button/>

                </div>
            </form>
        </div>
    </div>
@endsection

