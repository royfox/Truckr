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

    $('textarea').textcomplete([
        { // html
            match: /\B@(\w*)$/,
            search: function (term, callback) {
                callback($.map(usernames, function (mention) {
                    return mention.indexOf(term) === 0 ? mention : null;
                }));
            },
            index: 1,
            replace: function (mention) {
                return '@' + mention + ' ';
            }
        },
        { // emoji strategy
            match: /\B:([\-+\w]*)$/,
            search: function (term, callback) {
                callback($.map(emojies, function (emoji) {
                    return emoji.indexOf(term) === 0 ? emoji : null;
                }));
            },
            template: function (value) {
                return '<img class="emoji" src="/img/emoji/' + value + '.png"></img>' + value;
            },
            replace: function (value) {
                return ':' + value + ': ';
            },
            index: 1,
            maxCount: 5
        }
    ]);


});

function prettifyCode(){
    $("code").addClass("prettyprint");
    prettyPrint();
}