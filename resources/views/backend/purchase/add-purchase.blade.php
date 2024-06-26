
@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchase</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
       
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>Add Purchase
                  <a href="{{route('purchase.view')}}" class="btn btn-success float-right btn-sm"><i 
                  class="fa fa-list"></i>Purchase List</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">

               <!-- <form action="{{route('products.store')}}" method="POST" id="myForm" enctype="multipart-data/form" >
                @csrf -->

                <div class="form-row">
                   <div class="form-group col-md-4">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="date" class="form-control datepicker form-control-sm" placeholder="YYYY-MM-DD" readonly >
                   
                    
                    </div>


                  
                   <div class="form-group col-md-4">
                    <label >Purchase Number</label>
                    <input type="text" name="purchase_no" id="purchase_no" class="form-control form-control-sm">
                   
                    
                    </div>

                    <div class="form-group col-md-4">
                    <label for="supplier_id">supplier name</label>
                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                    <option value="">Select supplier</option>
                    @foreach($supplier as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach


                    </select>
                    
                    </div>

                    
                    <div class="form-group col-md-4">
                        <label for="name">Category</label>
                        <select name="category_id" id="category_id" class="form-control select2">
                         <option value="">Select category</option>
                   
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Product Name</label>
                        <select name="product_id" id="product_id" class="form-control select2">
                         <option value="">Select product</option>
                   
                        </select>
                    </div>


                    <div class="form-group col-md-2" style="padding-top:30px;">
                    <a  class="btn btn-success float-right btn-sm addeventmore" ><i 
                  class="fa fa-plus-circle "></i>Add item</a>
                    </div>

                   
                </div>

               <!-- </form> -->

             
              
                </div>
              </div><!-- /.card-body -->
              <div class="card-body">
                <form action="{{route('purchase.store')}}" method="POST" id="myForm">
                  @csrf 
                  <table class="table-sm table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th width="7%">PCS/KGS</th>
                        <th width="10%">Unit Price</th>
                        <th>Description</th>
                        <th width="10%">Total Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody class="addRow" id="addRow">

                    </tbody>
                    <tbody>
                      <tr>
                      <td colspan="5"></td>
                      <td>
                        <input type="text" name="estimated_amount" value="0" id="estimated_amount"
                        class="form-control from-control-sm text-right estimated_amount" readonly style="background-color:#DBFDBA">
                      </td>
                      <td></td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="storeButton">Purchase Store</button>
                  </div>


                </form>
              </div>
               
            </div>
            <!-- /.card -->

            <!-- DIRECT CHAT -->
           
            <!--/.direct-chat -->

            <!-- TO DO List -->
          
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
      <input type="hidden" name="date[]" value="@{{date}}" >
      <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}" >
      <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}" >
      <td>
      <input type="hidden" name="category_id[]" value="@{{category_id}}" >
       @{{category_name}}
      </td>
      <td>
      <input type="hidden" name="product_id[]" value="@{{product_id}}" >
      @{{product_name}}
      </td>
      <td>
        <input type="number" min="1" class="form-control form-control-sm text-right buying_qty"
        name="buying_qty[]" value="1">
      </td>
      <td>
        <input type="number" class="form-control form-control-sm text-right unit_price" 
        name="unit_price[]" value="">
      </td>
      <td>
        <input type="text" name="description[]" class="form-control form-contol-sm"  >
      </td>
      <td>
        <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0"
        readonly>
      </td>
      <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>

  </script>

  <script>
    $(document).ready(function(){

      $(document).on("click",".addeventmore",function(){

        var date=$('#date').val();
        var purchase_no=$('#purchase_no').val();
        var supplier_id=$('#supplier_id').val();
        var category_id=$('#category_id').val();
        var category_name=$('#category_id').find('option:selected').text();
        var product_id=$('#product_id').val();
        var product_name=$('#product_id').find('option:selected').text();

        if(date==''){
          $.notify("Data is required",{globalPosition:'top right',className:'error'});
          return false;
        }
        if(purchase_no==''){
          $.notify("purchase is required",{globalPosition:'top right',className:'error'});
          return false;
        }

        if(supplier_id==''){
          $.notify("supplier is required",{globalPosition:'top right',className:'error'});
          return false;
        }
        if(category_id==''){
          $.notify("category is required",{globalPosition:'top right',className:'error'});
          return false;
        }
        if(product_id==''){
          $.notify("product is required",{globalPosition:'top right',className:'error'});
          return false;
        }
        // var source = document.getElementById("document-template").innerHTML;
        // var template = Handlebars.compile(source);
        var source=$("#document-template").html();
        var template=Handlebars.compile(source);

        var data={
          date:date,
          purchase_no:purchase_no,
          supplier_id:supplier_id,
          category_id:category_id,
          category_name:category_name,
          product_id:product_id,
          product_name:product_name,

        };
        var html=template(data);
        $('#addRow').append(html);
      });

      $(document).on("click",".removeeventmore",function(event){
        $(this).closest(".delete_add_more_item").remove();
        totlalAmountPrice();
      });
      $(document).on("keyup click",".unit_price,.buying_qty",function(){
        var unit_price=$(this).closest("tr").find("input.buying_qty").val();
        var qty=$(this).closest("tr").find("input.unit_price").val();
        var total=unit_price * qty;
        $(this).closest("tr").find("input.buying_price").val(total);
        totlalAmountPrice();

      });
      // calculate sum of amount in invoice
      function totlalAmountPrice(){

        var sum=0;
        $(".buying_price").each(function(){
          var value=$(this).val();
          if(!isNaN(value) && value.length !=0){
            sum +=parseFloat(value);
          }
        });
        $('#estimated_amount').val(sum);
        
      }
    });
  </script>

  <!-- Jquery Validation=================== -->
  <script>
    $(function () {
     
      $('#myForm').validate({
        rules: {
         
          name:{
            required:true,
          },
          supplier_id: {
            required: true,
          
          },
          categories_id:{
            required:true,
            
          },
          units_id:{
            required:true,
           
          }
          
        },
        messages: {
         
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>

<script>
  $(function(){

    $(document.body).on('change','#supplier_id',function(){
      var supplier_id=$(this).val();
      $.ajax({
       
        url:"{{route('get-category')}}",
        type:"GET",
        data:{supplier_id:supplier_id},

        success:function(data){
          var html='<option value="">select category</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.category_id+'"> '+ v.category.name +'</option>';
          });
          $('#category_id').html(html);
        }
      });

    });
  });
</script>

<script>
  $(function(){

    $(document.body).on('change','#category_id',function(){
      var category_id=$(this).val();
      $.ajax({
       
        url:"{{route('get-product')}}",
        type:"GET",
        data:{category_id:category_id},

        success:function(data){
          var html='<option value="">select product</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.id+'"> '+ v.name +'</option>';
          });
          $('#product_id').html(html);
        }
      });

    });
  });
</script>
<script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>

  @endsection