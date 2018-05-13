<div class="card">
    <div class="header">
        {!! $grid->renderHeaderTools() !!}

        {!! $grid->renderFilter() !!}
        {!! $grid->renderExportButton() !!}
        {!! $grid->renderCreateButton() !!}
    </div>
    <div class="body table-responsive no-padding">
        <table class="table table-bordered table-hover">
            <tr>
                @foreach($grid->columns() as $column)
                <th>{{$column->getLabel()}}{!! $column->sorter() !!}</th>
                @endforeach
            </tr>

            @foreach($grid->rows() as $row)
            <tr {!! $row->getRowAttributes() !!}>
                @foreach($grid->columnNames as $name)
                <td {!! $row->getColumnAttributes($name) !!}>
                    {!! $row->column($name) !!}
                </td>
                @endforeach
            </tr>
            @endforeach

            {!! $grid->renderFooter() !!}

        </table>
    </div>
    <div class="box-footer clearfix">
        {!! $grid->paginator() !!}
    </div>
</div>