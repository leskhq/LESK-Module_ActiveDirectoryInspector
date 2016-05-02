@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box box-primary">
            <div class="box-header with-border">

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

                <div class="box-body">


                    {!! Form::open(['route' => 'activedirectoryinspector.home', 'method' => 'GET']) !!}

                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_general" data-toggle="tab" aria-expanded="true">{!! trans('activedirectoryinspector::general.tabs.general') !!}</a></li>
                            <li class=""><a href="#tab_member_of" data-toggle="tab" aria-expanded="false">{!! trans('activedirectoryinspector::general.tabs.member_of') !!}</a></li>
                            <li class=""><a href="#tab_raw" data-toggle="tab" aria-expanded="false">{!! trans('activedirectoryinspector::general.tabs.raw') !!}</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_general">
                                <div class="form-group">
                                    {!! Form::label('username', trans('activedirectoryinspector::general.columns.username')) !!}
                                    {!! Form::text('username', $adRecord['samaccountname'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('first_name', trans('activedirectoryinspector::general.columns.first_name')) !!}
                                    {!! Form::text('first_name', $adRecord['givenname'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('last_name', trans('activedirectoryinspector::general.columns.last_name')) !!}
                                    {!! Form::text('last_name', $adRecord['sn'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('displayname', trans('activedirectoryinspector::general.columns.displayname')) !!}
                                    {!! Form::text('displayname', $adRecord['displayname'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('description', trans('activedirectoryinspector::general.columns.description')) !!}
                                    {!! Form::text('description', $adRecord['description'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('physicaldeliveryofficename', trans('activedirectoryinspector::general.columns.physicaldeliveryofficename')) !!}
                                    {!! Form::text('physicaldeliveryofficename', $adRecord['physicaldeliveryofficename'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('telephonenumber', trans('activedirectoryinspector::general.columns.telephonenumber')) !!}
                                    {!! Form::text('telephonenumber', $adRecord['telephonenumber'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email', trans('activedirectoryinspector::general.columns.email')) !!}
                                    {!! Form::text('email', $adRecord['mail'][0], ['class' => 'form-control', 'readonly']) !!}
                                </div>

                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_member_of">
                                <div class="form-group">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>{{ trans('activedirectoryinspector::general.columns.dn') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($arrMemberOf))
                                                @foreach($arrMemberOf as $member)
                                                    <tr>
                                                        <td>{!! link_to_route('activedirectoryinspector.show', $member, [$member], []) !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_raw">
                                <div class="form-group">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>{{ trans('activedirectoryinspector::general.columns.key') }}</th>
                                                    <th>{{ trans('activedirectoryinspector::general.columns.value') }}</th>
                                                </tr>
                                            </thead>
                                            @if (isset($arrRecord))
                                                <tfoot>
                                                    <tr>
                                                        <th>{{ trans('activedirectoryinspector::general.columns.key') }}</th>
                                                        <th>{{ trans('activedirectoryinspector::general.columns.value') }}</th>
                                                    </tr>
                                                </tfoot>
                                            @endif
                                            <tbody>
                                            @if (isset($arrRecord))
                                                @foreach($arrRecord as $arrKey => $arrVal)
                                                    <tr>
                                                        <td>{{$arrKey}}</td>
                                                        <td>{{$arrVal}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.tab-pane -->

                        </div><!-- /.tab-content -->
                    </div>

                    <div class="form-group">
                        <a href="#" class="btn btn-primary" onclick="goBack()">{{ trans('general.button.close') }}</a>
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
    @endsection


<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <script>
        function goBack() {
            window.history.back()
        }
    </script>
@endsection
