$(document).ready(function(){
    $('#navigation .menu .title').hover(
        function(){
            $(this).addClass("hover");
        },
        function(){
            $(this).removeClass("hover");
        }
     );
});