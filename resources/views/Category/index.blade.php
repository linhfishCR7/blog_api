@extends('layout')

@section('title')
List Categories
@endsection
@section('feature-title')
List Categories
@endsection
@section('content')
@if (Session::get('alert-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{Session::get('alert-success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::get('alert-warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('alert-warning')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        List Category
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>

                </tr>
            </tfoot>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>
                        <a href="{{URL::to('edit-category')}}/{{$category->id}}" class="btn btn-outline-primary btn-sm">Edit</a>
                        |
                        <form method="POST" action="{{URL::to('delete-category')}}/{{$category->id}}" class="frmDelete" data-id="{{$category->id}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>


@endsection
@section('custom-script')
<script>
    $(function() {
        //class frmDelete th??m v??o ch??? n??t delete
        $('.frmDelete').submit(function(e) {
            //d???ng c??c s??? ki???n m???c ?????nh
            e.preventDefault();
            //l???y d??? li???u t??? data-id tr??n form c???a n??t x??a
            var id = $(this).data('id');
            //debugger;
            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) { //n???u yes th?? s??? l??
                    //h??m l???y t???t c??? d??? li???u
                    //x??a d??? li???u d???ng ??i???u h?????ng
                    //var sendData = $(this).serialize();

                    //g???i y??u c??u ??i
                    $.ajax({
                        type: $(this).attr('method'), //lo???i g???i ??i post,get....
                        url: $(this).attr('action'), //???????ng d???n ?????n n???i x??a d??? li???u
                        //data: sendData,
                        //g???i d??? li???u b???ng tay

                        data: {
                            //id l?? ph???i c??ng v???i para trong action destroy
                            id: id
                            , _token: $(this).find('[name=_token').val()
                            , _method: $(this).find('[name=_method').val(),

                        },
                        //dataType: 'JSON'
                        // success hay fail c?? hay kh??ng c??ng kh??ng sao
                        success: function(data, textStatus, jqXHR) {
                            //load l???i trang khi ???? x??a
                            Swal.fire(
                                'Deleted!'
                                , 'Your file has been deleted.'
                                , 'success'
                            );
                            location.href = '{{ route('category.index')}}'
                        }
                        , error: function(jqXHR, textStatus, errorThrown) {}
                    , });

                } else {
                    Swal.fire(
                        'Cancelled!'
                        , 'Your imaginary file is safe :)'
                        , 'error'
                    );
                }
            })
            ///
        });

    });

</script> 
@endsection
