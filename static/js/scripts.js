function loader(url){
    url = url.replace(/^.*[\\/]/, ""); //replaces everything between '/' and '/' with empty string
    $.ajax({
        type: "GET",
        url: "/includes/load_html.php",
        data: 'page='+url,
        dataType: "html",
        success: function(msg){
            if(parseInt(msg)!=0){
                $('main').html(msg);
                $('main').hide().fadeIn(100);
            }
        }
    });
}
function navbarLoader(c){
    var $linkClicked = c.attr("href").replace(/^#/, ""); //replaces every '#' with empty string
    if($linkClicked.length > 0){
        window.history.pushState(null, null, $linkClicked);     //manipulates the history
        $(".nav a").parent().removeClass("active");
        c.parent().addClass("active");
        loader($linkClicked);
    }
}
$(window).on('popstate', function() {
    var $pageRoot = window.location.pathname.replace(/^.*[\\/]/, "");
    if($pageRoot.length === 0)
        $pageRoot = 'home';
    loader($pageRoot);
});


$(function() {
    /*if(window.location.hash.length === 0){
        loader('home');
    }else{
        //var $pageRoot = window.location.hash.replace(/^#/, '');
        var $pageRoot = window.location.pathname.replace(/^.*[\\/]/, "");
        if($pageRoot.length > 0){
            loader($pageRoot);
        }
    }
    */
    $('[data-html]').each(function(i, div){
        var url = div.getAttribute("data-html");
        loader(url);
    });

    $('.nav a').on("click", function(event) {
        if($(this).parent().hasClass("target"))
            return;
        if($(event.target).attr('class') != 'dropdown-toggle')
            $('.navbar-collapse').collapse('hide');
        event.preventDefault();
        navbarLoader($(this));
    });
});
