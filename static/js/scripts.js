$(document).ready(function() {
    if(window.location.hash.length === 0){
        loader('home');
    }else{
        var $pageRoot = window.location.hash.replace(/^#/, '');
        if($pageRoot.length > 0){
            loader($pageRoot);
        }
    }
    function loader(href){
        $.ajax({
            type: "POST",
            url: "includes/load_html.php",
            data: 'page='+href,
            dataType: "html",
            success: function(msg){
                if(parseInt(msg)!=0){
                    $('#main-content').html(msg);
                }
            }
        });
    }
    $('nav a').click(function() {
        var $linkClicked = $(this).attr('href');
        if(typeof $linkClicked !== typeof undefined && $linkClicked !== false){
            window.location.hash = $linkClicked;
            var $pageRoot = $linkClicked.replace(/^#/, '');
            if($pageRoot.length > 0){
                if (!$(this).parent().hasClass("active")) {
                    $("nav a").parent().removeClass("active");
                    $(this).parent().addClass("active");
                    loader($pageRoot);
                }
                else {
                    event.preventDefault();
                }
            }
        }
    });
});
