@extends('adminLayout')

<style>
    .row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .box {
        height: 20px;
        width: 20px;
        border: 1px solid black;
        margin-right: 5px;
        margin-top: 2%;
        float: right;
        text-align: center;
        cursor: pointer;
    }

    .delete {
        display: none;
    }

    .box:hover + .delete {
        display: block;
    }

</style>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$pagename ?? ""}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">

            @if(!$key2)

                <div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                    @if($addNew)

                                        <div style="float:right!important; margin-left:2%">

                                            <a class="btn btn-block btn-info"
                                               href="{{ url('/'.$tables .'/'. $formPage . '/insertData') }}">
                                                <i class="fa ">
                                                </i>
                                                {{$addNew}}
                                            </a>
                                        </div>
                                    @endif

                                    @if($showRecords)

                                        <div style="float:right!important;">

                                            <a class="btn btn-block btn-info"
                                               href="{{ url('/'.$tables .'/'. $recordPage . '/display') }}">
                                                <i class="fa ">
                                                </i>
                                                {{$showRecords}}
                                            </a>
                                        </div>
                                    @endif

                                    {{--                                                                     search --}}
                                    <form action="{{ route($tables.'.search') }}" method="get">
                                        @csrf

                                        <div style="align-items:flex-start; float:left!important;">

                                            <div class="input-group input-group-sm" style="width:400px;">


                                                <input name="search" type="text" class="form-control float-right"


                                                       @if($tables. "/search"==request()->path())
                                                       placeholder="{{$placeHolder? $placeHolder : 'Search'}}"
                                                       required

                                                       @else
                                                       placeholder="Search"
                                                       required
                                                    @endif
                                                >
                                                <div class="input-group-append">


                                                    <button type="submit" name="btnSearch" class="btn btn-default">
                                                        <i class="fa fa-search"></i>

                                                    </button>
                                                    @if($tables === 'reports')
                                                        <a name="btnCancel"
                                                           href="{{ url('comments/comment_reports/display') }}"
                                                           onclick="window.location='{{ url('/'.$tables ) }}"
                                                           class="btn btn-default">
                                                            <i class="fa fa-close"></i>

                                                        </a>                                                                                        @else
                                                        <a name="btnCancel" href="{{ url('/'.$tables) }}"
                                                           onclick="window.location='{{ url('/'.$tables ) }}"
                                                           class="btn btn-default">
                                                            <i class="fa fa-close"></i>

                                                        </a>
                                                    @endif


                                                </div>


                                            </div>

                                        </div>
                                    </form>
{{--                              search --}}

                                    <div>
                                        <img src="data:image/jpeg;base64,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">
                                    </div>

                                </div>

                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table id="tableprofider" class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            @for( $i = 0 ; $i<=10 ; $i++)


                                                @if(isset($columns[$i]) && $columns[$i]!='fakeId')
                                                    <th>{{$columns[$i]}}</th>
                                                @endif

                                            @endfor

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                            @foreach( $rows as $rows)

                                                @for( $i = 0 ; $i<=10; $i++)

                                                    @if(isset($columns[$i]) && ($columns[$i] == "الصورة/رابط الفيديو" || $columns[$i] == "الصورة" || $columns[$i] == "الصورة الشخصية"))
                                                        <td>
                                                            {{--                                                            <a  herf="{{ url('/'.$tables .'/fetch_image/'. $rows->medl_id ) }}">--}}

                                                            <img width="60"
                                                                 height="60"
                                                                 class="img"
                                                                 name="{{$rows->medl_id ?? $rows->cla_id ?? $rows->social_id}}"
                                                                 id="img"
                                                                 src="{{$tables}}/fetch_image/{{ $rows->medl_id  ?? $rows->cla_id ?? $rows->social_id}}"
                                                                 onclick="displayImage()">

                                                            {{--                                                            </a>--}}
                                                        </td>
                                                    @elseif(isset($columns[$i]) && $columns[$i] == "الألوان")
                                                        <?php $val = (string)$columns[$i] ?>
                                                        <?php $color = (string)$rows->$val ?>

                                                        <td>
                                                            {{--                                                        @foreach($columns as $columns)--}}
                                                            <div class='box'
                                                                 style="background-color:{{$color}} !important;">
                                                                hh
                                                            </div>
                                                            {{--                                                        @endforeach--}}
                                                        </td>

                                                    @elseif(isset($columns[$i]) && $columns[$i]!='fakeId')
                                                        <?php $val = (string)$columns[$i] ?>
                                                        {{--                                                    @if(str_contains($rows->$val, "#"))--}}
                                                        {{--                                                    @dd($rows->$val)--}}

                                                        {{--                                                        <td>--}}

                                                        {{--                                                            <div class='box'--}}
                                                        {{--                                                                  style="background-color:red !important;">--}}
                                                        {{--hh--}}
                                                        {{--                                                            </div>--}}

                                                        {{--                                                        </td>--}}

                                                        {{--                                                    @else--}}
                                                        @if($key)
                                                            @if(str_contains(strtolower($rows->$val), strtolower($key)) && isset($_GET['btnSearch']))
                                                                <td style="background-color: yellow ">{{$rows->$val}}</td>
                                                            @else
                                                                <td>{{$rows->$val}}</td>
                                                            @endif
                                                        @else
                                                            <td>{{$rows->$val}}</td>
                                                        @endif
                                                        {{--                                                    @endif--}}

                                                    @endif
                                                @endfor

                                                <td class="project-actions text-right">
                                                    @if($displayDetailes)
                                                        <a class="btn btn-secondary btn-sm"
                                                           href="{{ url('/'.$tables .'/'. $rows->fakeId . '/displayDetailes') }}">
                                                            <i class="fa ">
                                                            </i>
                                                            عرض التفاصيل
                                                        </a>
                                                    @endif
                                                    @if(isset($rows->state))
                                                        @if($rows->state)
                                                            <a class="btn btn-success btn-sm"
                                                               href="{{ url('/'.$tables .'/'. $rows->fakeId . '/enableordisable') }}">
                                                                <i class="fa ">
                                                                </i>
                                                                @if($tables === 'reports')
                                                                    تجاهل
                                                                @else
                                                                    تعطيل
                                                                @endif

                                                            </a>
                                                        @elseif(!$rows->state)
                                                            <a class="btn btn-primary btn-sm"
                                                               href="{{ url('/'.$tables .'/'. $rows->fakeId . '/enableordisable') }}">
                                                                <i class="fa ">
                                                                </i>
                                                                @if($tables === 'reports')
                                                                    الغاء التجاهل
                                                                @else
                                                                    تفعيل
                                                                @endif
                                                            </a>
                                                        @endif
                                                    @endif

                                                    @if(!$noUpdateBtn)

                                                        <a class="btn btn-info btn-sm"
                                                           href="{{ url('/'.$tables .'/'. $rows->fakeId . '/update') }}">
                                                            <i class="fa fa-pencil">

                                                            </i>
                                                            تعديل
                                                        </a>
                                                    @endif

                                                    @if(!$noDeleteBtn)

                                                        <a class="btn btn-danger btn-sm deletee"
                                                           href="{{ url('/'.$tables .'/'. $rows->fakeId . '/delete') }}">
                                                            <i class="fa fa-trash">
                                                            </i>
                                                            حذف
                                                        </a>
                                                </td>
                                                @endif


                                        </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                    {{--                                {!! $rows->links() !!}--}}

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </div>
            @endif


            {{--            //////////////////////////////////////////// Contact information second table /////////////////////////////////////////////            @if('contact_information' === $tables)--}}

            @if("contact_information" === $tables2)
                <div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                    @if($addNew2)

                                        <div style="float:right!important; margin-left:2%">

                                            <a class="btn btn-block btn-info"
                                               href="{{ url('/'.$tables2 .'/'. $formPage2 . '/insertData') }}">
                                                <i class="fa ">
                                                </i>
                                                {{$addNew2}}
                                            </a>
                                        </div>
                                    @endif

                                    {{--                                     search--}}

                                    <form action="{{ route($tables2.'.search2') }}" method="get">
                                        @csrf

                                        <div style="align-items:flex-start; float:left!important">

                                            <div class="input-group input-group-sm" style="width:400px;">


                                                <input name="search2" type="text" class="form-control float-right"


                                                       @if($tables2. "/search"==request()->path())
                                                       placeholder="{{$placeHolder? $placeHolder : 'Search'}}"
                                                       required

                                                       @else
                                                       placeholder="Search"
                                                       required
                                                    @endif
                                                >
                                                <div class="input-group-append">


                                                    <button type="submit" name="btnSearch2" class="btn btn-default">
                                                        <i class="fa fa-search"></i>

                                                    </button>
                                                    <a name="btnCancel2" href="{{ url('/'.$tables2) }}"
                                                       onclick="window.location='{{ url('/'.$tables2 ) }}"
                                                       class="btn btn-default">
                                                        <i class="fa fa-close"></i>

                                                    </a>


                                                </div>


                                            </div>

                                        </div>
                                    </form>
                                    {{--                                     search--}}
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table id="tableprofider" class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            @for( $i = 0 ; $i<=10 ; $i++)


                                                @if(isset($columns2[$i]) && $columns2[$i]!='fakeId')
                                                    <th>{{$columns2[$i]}}</th>
                                                @endif

                                            @endfor

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                            @foreach( $rows2 as $rows2)

                                                @for( $i = 0 ; $i<=10; $i++)
                                                    @if(isset($columns2[$i]) && $columns2[$i]!='fakeId')

                                                        <?php $val2 = (string)$columns2[$i] ?>


                                                        @if($key2)
                                                            @if(str_contains((string)$rows2->$val2, (string)$key2) && isset($_GET['btnSearch']))
                                                                <td style="background-color: yellow ">{{$rows2->$val2}}</td>
                                                            @else
                                                                <td>{{$rows2->$val2}}</td>
                                                            @endif
                                                        @else
                                                            <td>{{$rows2->$val2}}</td>
                                                        @endif
                                                    @endif

                                                @endfor

                                                <td class="project-actions text-right">

                                                    @if(isset($rows2->state))
                                                        @if($rows2->state)
                                                            <a class="btn btn-success btn-sm"
                                                               href="{{ url('/'.$tables2 .'_2/'. $rows2->fakeId . '/enableordisable') }}">
                                                                <i class="fa ">
                                                                </i>
                                                                تعطيل
                                                            </a>
                                                        @elseif(!$rows2->state)
                                                            <a class="btn btn-primary btn-sm"
                                                               href="{{ url('/'.$tables2 .'_2/'. $rows2->fakeId . '/enableordisable') }}">
                                                                <i class="fa ">
                                                                </i>
                                                                تفعيل
                                                            </a>
                                                        @endif
                                                    @endif

                                                    @if(!$noUpdateBtn)

                                                        <a class="btn btn-info btn-sm"
                                                           href="{{ url('/'.$tables2 .'_2/'. $rows2->fakeId . '/update') }}">
                                                            <i class="fa fa-pencil">

                                                            </i>
                                                            تعديل
                                                        </a>
                                                    @endif

                                                    @if(!$noDeleteBtn)

                                                        <a class="btn btn-danger btn-sm deletee"
                                                           href="{{ url('/'.$tables2 .'_2/'. $rows2->fakeId . '/delete') }}">
                                                            <i class="fa fa-trash">
                                                            </i>
                                                            حذف
                                                        </a>
                                                </td>
                                                @endif


                                        </tr>

                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </div>

            @endif
            {{--            //////////////////////////////////////////// Contact information second table /////////////////////////////////////////////--}}

        </section>

        {{--        <script src="{{ asset('resources/js/app.js/displayImage()') }}"></script>--}}

        <script>

            function displayImage(e) {
                var elem = document.getElementsByClassName('img');
                e = e || window.event;
                var t = e.target;
                var imgArray = $('[id^=img]').map(function (i) {
                    //return this.name;
                    // alert(this.name)
                    if (t.name == this.name) {
                        window.location.href = t.src;
                    }
                    return this.value; // for real values of input
                }).get();
            }
        </script>
@endsection

