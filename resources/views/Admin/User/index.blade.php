@extends('layout.app')
@extends('partial.navbar')
@extends('partial.sidevar')
@section('content')
@include('sweetalert::alert')
<style>
  .approve-btn{
    height: 20px !important;
    line-height: 0.5 !important;
    background-image: linear-gradient(140deg, #c77561 0%, #418b14 50%, #bb7d8c 75%) !important;
    border: none !important;
   }
 .unapprove-btn{
    height: 20px !important;
    line-height: 0.5 !important;
    background-image: linear-gradient(140deg, #6169c7 0%, #8b142a 50%, #2027c5 75%) !important;
    border: none !important;
  }
   
</style>
   <section>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="m-0">All User List</h1>
                  </div><!-- /.col -->
               </div><!-- /.row -->
            </div><!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->
          <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Intrested</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <?php $i = 1 ?>
                  @if(isset($data))
                  @foreach ($data as $item)
                     <tbody>
                        <tr>
                        <td>{{$i ++}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->intrested}}</td>
                        <td>
                        @if($item->status == 1)
                           <a href="{{route('user.approve', $item->id)}}" class="btn btn-success approve-btn btn-sm approve-btn">APPROVE</a>
                           @else
                           <a href="{{route('user.approve', $item->id)}}" class="btn btn-danger unapprove-btn btn-sm">UNAPPROVE</a>
                        @endif
                        </td>
                        <td>
                           <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $item->id }}" >Delete</button>
                        </td>
                        </tr>
                    </tbody>
                  @endforeach
                  @endif
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Intrested</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {!! $data->links() !!}
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
      </div>

      <script>
         $(document).ready(function() {
            $(".deleteRecord").click(function(){
               var id = $(this).data("id");
               var token = $("meta[name='csrf-token']").attr("content");
               
               $.ajax(
               {
                  url: "users/"+id,
                  type: 'DELETE',
                  data: {
                        "id": id,
                        "_token": token,
                  },
                  success: function (){
                        console.log("it Works");
                        window.location.reload(true);
                  }
               });
            });
         });
      </script>
</section>
  
@endsection
@extends('partial.footer')
 