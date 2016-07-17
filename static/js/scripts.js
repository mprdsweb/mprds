$(document).ready(function() {
    console.log("Document ready function");
    if (window.sessionStorage.getItem("main-content") === null) {
        console.log("No session storage");
        $.ajax({
            type: "POST",
            url: "includes/load_html.php",
            data: 'page=home',
            dataType: "html",
            success: function(msg){
                if(parseInt(msg)!=0){
                    console.log(msg);
                    $('#main-content').html(msg);
                    //$('#main-content #page-content').hide().fadeIn();
                    window.sessionStorage.setItem("main-content", msg); // store it in session
                }
            }
        });
    } else {
        var jsData = window.sessionStorage.getItem("main-content");
        $('#main-content').html(jsData);
    }

    $('.nav a').click(function() {
        var $linkClicked = $(this).attr('href');
        if(typeof $linkClicked !== typeof undefined && $linkClicked !== false){
            window.location.hash = $linkClicked;
            var $pageRoot = $linkClicked.replace(/^#/, '');
            if($pageRoot.length > 0){
                if (!$(this).parent().hasClass("active")) {
                    $(".nav a").parent().removeClass("active");
                    $(this).parent().addClass("active");
                    $.ajax({
                        type: "POST",
                        url: "includes/load_html.php",
                        data: 'page='+$pageRoot,
                        dataType: "html",
                        success: function(msg){
                            if(parseInt(msg)!=0){
                                $('#main-content').html(msg);
                                //$('#main-content #page-content').hide().fadeIn();
                                //window.sessionStorage.setItem("main-content", msg); // store it in session
                            }
                        }
                    });
                }
                else {
                    event.preventDefault();
                }
            }
        }
    });
});
