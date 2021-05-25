$(document).ready(function(){

  function insert_note(){
      var text=$(".insert_note_text").html();
      var title=$(".insert_note_title").html();
      $.ajax({
          url:base_url+"Notes/insert_note",
          type:"POST",
          data:{"text":text,"title":title},
          success: function(response){
              response= JSON.parse(response);
              if(response.result=="success"){
                reload_notes();
                $("#insert_note").html("Take a note...");
                $("#insert_note").removeClass("expanded");
                $(".insert_note_card").height("auto");
              }
          }
      });
  }

  function refresh_notes(notes){
    $(".notes").empty();
    var notes_html="";
    var row=0;
    $.each(notes, function(i,val){
      if(!val.title){
        val.title="";
      }
      if(!val.text){
        val.text="";
      }
      row++;
      if(row==1){
        notes_html +='<div class="row mb_10 mt_10">';
      }
      notes_html +='  <div class="col-sm-3"><div class="card full-height note" data-id="'+val.id+'"><div class="card-body">  <span title="Delete Note" class="delete float-right text-danger" data-id="'+val.id+'"><i class="fa fa-trash"></i></span><h5 class="card-title">'+val.title+'</h5><p class="card-text">'+val.text+'</p></div></div></div>';
      if(row==4){
        notes_html +='</div>';
        row=0;
      }
    });
    $(".notes").append(notes_html);
  }

  function reload_notes(){
        $.ajax({
          url: base_url+"Notes/get_notes",
          type: "POST",
          success: function(response){
            response = JSON.parse(response);
            if(response.result=="success"){
              refresh_notes(response.notes)
            }

          }
        });

  }


  $("body").on("click","#insert_note",function(){
    if(!$(this).hasClass("expanded")){
        $(".insert_note_card").html('<div id="insert_note" class="card-body light_gray expanded" contenteditable="true" data-text="Take a note..."><h5 class="card-title text-muted insert_note_title">Title</h5><div class="insert_note_text"></div><div id="save_note" class="btn btn-info">Save</div></div>');
        $(".insert_note_card").height(300);
        $(".insert_note_text").height(190);
        $("#save_note").attr("contenteditable","false");
      }
    });

  $("body").on("click","#save_note",function(){
      insert_note();
  });

  $("#search").keyup(function(){
    var search=$.trim($(this).val());
    if(search != ""){
      $.ajax({
        url:base_url+"Notes/search",
        type:"POST",
        data:{"search":search},
        success: function(response){
          response= JSON.parse(response);
          if(response.result=="success"){
              refresh_notes(response.notes);
          }

        }
      });
    }
    else{
      reload_notes();
    }
  });

  $("body").on("click",".delete",function(){
    var id = $(this).attr("data-id");
    var res= confirm("Are you sure you want to delete this note?");
    if(res){
      $.ajax({
        url:base_url+"Notes/delete_note",
        type:"POST",
        data:{"id":id},
        success: function(response){
          response= JSON.parse(response);
          if(response.result=="success"){
            reload_notes();
          }
        }
      });
    }
  });

  $("body").on("click",".modal-delete",function(){
    var id = $('.modal-body').attr("data-id");
    var res= confirm("Are you sure you want to delete this note?");
    if(res){
      $.ajax({
        url:base_url+"Notes/delete_note",
        type:"POST",
        data:{"id":id},
        success: function(response){
          response= JSON.parse(response);
          if(response.result=="success"){
            reload_notes();
            $(".modal").modal("toggle");
          }
        }
      });
    }
  });

$("body").on("click",".note",function(e){
  if($(e.target).closest('.delete').length>=1){
    return;
  }
  var title=$(this).find( ".card-title" ).html();
  var text = $(this).find( ".card-text" ).html();
   $(".modal-body").attr("data-id",$(this).attr("data-id"));
  $("#modal-title").html(title);
  $("#modal-text").html(text);
    $(".modal").modal("toggle");
});

$(".modal-body").keyup(function(){
  $("#modal-saving").html(" Saving...");
  var id=$(".modal-body").attr("data-id");
  var title=$("#modal-title").html();
  var text=$("#modal-text").html();
  $.ajax({
    url:base_url+"Notes/update_note",
    type:"POST",
    data:{"id":id,"title":title,"text":text},
    success:function(response){
      response=JSON.parse(response);
      if(response.result=="success"){
        $("#modal-saving").html(" Saved");
        reload_notes();
      }
    }
  });
});

});// end document.ready
