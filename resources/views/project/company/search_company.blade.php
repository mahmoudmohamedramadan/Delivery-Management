@section('companySection')
    @foreach ($companies as $company)
        <tr class="row-{{ $company->id }}">
            <td>{{ $company->id }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->manager }}</td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->phone }}</td>
            <td>
                <form action="" style="width:auto;margin:0px;padding:0px;background:none">
                    <input type="button" value="Edit Data" class="btn btn-success"
                        onclick="location.href= '/index/ajax/company/{{ $company->id }}/edit' ">
                    <input type="button" value="Delete Ajax" class="btn btn-danger" class="delete-ajax"
                        delete-id="{{ $company->id }}">
                </form>
            </td>
    @endforeach
@endsection
