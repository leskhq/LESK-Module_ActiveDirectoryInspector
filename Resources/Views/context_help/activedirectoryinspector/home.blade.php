@extends('layouts.context_help_area')

@section('help_header')
    <i class="fa fa-book"></i>
    <h3 class="box-title">AD Inspector</h3>
@endsection


@section('help_content')
    <dl>
        <dd>
            Type the partial name of the item that you are looking for and click on
            the <i class="fa fa-search"></i> button to see the results.
        </dd>
        <dd>
            Once the result list displays, you will be able to click on an item to
            see it's details.
        </dd>
        <dd>
            Searches are performed against the <u>CN</u> field.
        </dd>
    </dl>
@endsection
