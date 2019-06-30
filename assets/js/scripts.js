$(document).ready(function(){

  base_url = $(".base_url").val();

  $(".delete-btn").click(function(){
    name = $(this).attr('data-name');
    action = $(this).attr('data-action');
    $(".modal strong.name").html(name);
    $(".c-del-btn").attr("data-id",action);
  });
  $(".c-del-btn").click(function(){
    url = $(this).attr('data-id');
    $.ajax({
      type:"POST",
      url:base_url+url,
      // dataType:"application/json",
      data:"",
      success:function(data){
        console.log(data);
        // if( data.status === "success" ){
          window.location.href = '';
          // }
      },
      error:function(err){
        console.log("Error",err);
      }

    });
  });
  $('.multi-select').dropdown();


  $(".add-new-row").click(function(){
    var table = $(".custom-table tbody:last");
    var html = '<tr>'+
                  '<td width="55%"><textarea rows="3" name="description[]" class="form-control"></textarea></td>'+
                  '<td><input type="text" name="price[]" value="0" class="form-control" placeholder="Price"></td>'+
                  '<td><input type="text" name="qty[]"  value="0" class="form-control" placeholder="Qty"></td>'+
                  '<td class="total">0.00</td>'+
                  '<td><button type="button" class="btn btn-xs btn-danger remove-row "><i class="fa fa-remove"></i></button></td>'+
                '</tr>';
    if( $(".custom-table tbody tr").length > 0)
      $(".custom-table tbody tr:first td:last").removeClass("hide");
    else
    $(".custom-table tbody tr:first td:last").addClass("hide");
    $(table).append(html);
  });

  $(".custom-table").on('click','.remove-row',function(){
    var cur = $(this).parent().parent();
    cur.remove();
    updateTable();
  });
  $(".custom-table").on('keyup','input[name="price[]"],input[name="qty[]"]',function(){
    updateTable();
  });

  var updateTable = function(){
    var len = $(".custom-table tbody tr").length;
    var subTotal = 0, gstTotal = 0, grandTotal = 0;

    for( var i=0; i< len ; i++)
    {
      row = i + 1;
      var p = $(".custom-table tbody tr:nth-child("+row+") td input[name='price[]']").val();
      var q = $(".custom-table tbody tr:nth-child("+row+") td input[name='qty[]']").val();
      var total = parseInt(p) * parseInt(q);
      subTotal = subTotal + total;
      $(".custom-table tbody tr:nth-child("+row+") td.total").html(total.toFixed(2));
    }
    gstTotal = (subTotal / 100 ) * 18;
    grandTotal = subTotal + gstTotal;
    $(".custom-table tfoot tr td.sub-total span").html( subTotal.toFixed(2) );
    $(".custom-table tfoot tr td.gst-total span").html( gstTotal.toFixed(2) );
    $(".custom-table tfoot tr td.grand-total span").html( grandTotal.toFixed(2) );

  }


  $(".view-invoice").click(function(){
    id = $(this).attr('data-id');
    inv_id = $(this).attr('data-inv-id');
    $(".inv-view-modal span.inv-no").html(inv_id);
    $.ajax({
      type:"POST",
      url:base_url+'invoice/get_invoice/'+id,
      contentType:"application/json",
      data:"",
      success:function(data){
        data = JSON.parse(data);
        console.log(data);
        $(".inv-view-modal .modal-body").html(data.data);
      },
      error:function(err){
        console.log("Error",err);
      }

    });
  });

});