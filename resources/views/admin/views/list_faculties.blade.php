@extends("admin.layouts.layout")

@section("title","Admin Dashboard | Online Web Tutor")

@section("content")

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List Faculties
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List Faculties</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered" id="list-faculties">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Faculty Type</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box -->

            </div>

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function () {

        $(document).on("click", ".btn-faculty-delete", function () {

            var conf = confirm("Are you sure want to delete ?");

            if (conf) {

                // ajax call functions
                var delete_id = $(this).attr("data-id"); // delete id of delete button

                var postdata = {
                    "_token": "{{ csrf_token() }}",
                    "delete_id": delete_id
                }

                $.post("{{ route('deletefaculty') }}", postdata, function (response) {

                    var data = $.parseJSON(response);

                    if (data.status == 1) {

                        location.reload();
                    } else {

                        alert(data.message);
                    }
                })
            }
        });
    });
</script>
@endsection