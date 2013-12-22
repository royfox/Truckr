$(document).ready(function(){
    $('#navigation .menu .title').hover(
        function(){
            $(this).addClass("hover");
        },
        function(){
            $(this).removeClass("hover");
        }
     );

    $("#ciconia-preview-tab").click(function(){
       var markdown = $("#ciconia-input textarea").val();
        $("#ciconia-preview").html("Loading preview...");
       $.ajax({
           url: "/posts/ciconia",
           type: "post",
           data: {markdown: markdown},
           success: function(response){
               $("#ciconia-preview").html(response);
               prettifyCode();
           }
       });
    });
    prettifyCode();
});

function prettifyCode(){
    $("code").addClass("prettyprint");
    prettyPrint();
}