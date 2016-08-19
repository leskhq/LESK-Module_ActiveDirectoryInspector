@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            {!! Form::open( array('route' => 'activedirectoryinspector.search', 'id' => 'frmADSearh') ) !!}
                <div class="box box-primary">
                <div class="box-header with-border">
                    {!! Form::text('txtADQuery', $query, [ 'placeholder' => 'Enter AD query', 'style' => 'max-width:150px;', 'id' => 'txtADQuery']) !!}
                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmADSearh'].action = '{{ route('activedirectoryinspector.search') }}';  document.forms['frmADSearh'].submit(); return false;" title="{{ trans('activedirectoryinspector::general.action.search') }}">
                        <i class="fa fa-search"></i>
                    </a>
                    &nbsp;

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ trans('activedirectoryinspector::general.columns.type') }}</th>
                                    <th>{{ trans('activedirectoryinspector::general.columns.cn') }}</th>
                                    <th>{{ trans('activedirectoryinspector::general.columns.samaccountname') }}</th>
                                    <th>{{ trans('activedirectoryinspector::general.columns.dn') }}</th>
                                </tr>
                                </thead>
                                @if ($adResults)
                                    <tfoot>
                                    <tr>
                                        <th>{{ trans('activedirectoryinspector::general.columns.type') }}</th>
                                        <th>{{ trans('activedirectoryinspector::general.columns.cn') }}</th>
                                        <th>{{ trans('activedirectoryinspector::general.columns.samaccountname') }}</th>
                                        <th>{{ trans('activedirectoryinspector::general.columns.dn') }}</th>
                                    </tr>
                                    </tfoot>
                                @endif
                                <tbody>
                                @if ($adResults)
                                    @foreach($adResults as $adResult)
                                        <tr>
                                            <td align="center"><i class="fa fa-{{$adResult['type-icon']}}" title="{{$adResult['type-label']}}"></i></td>
                                            <td>{!! link_to_route('activedirectoryinspector.show', $adResult['cn'], [$adResult['dn']], []) !!}</td>
                                            <td>
                                                @if(isset($adResult['samaccountname']))
                                                    {!! link_to_route('activedirectoryinspector.show', $adResult['samaccountname'], [$adResult['dn']], []) !!}
                                                @endif
                                            </td>
                                            <td>{!! link_to_route('activedirectoryinspector.show', $adResult['dn'], [$adResult['dn']], []) !!}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->

                    </div><!-- /.box-body -->

            </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->

    </div><!-- /.row -->
    @endsection


<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
@endsection
