var main;

String.prototype.capitalize = function() {
	if (this.length <= 1) return this;
    var words = this.replace("/"," s/s ");
	words = words.split(" ");
	for (var i in words)
		if (words[i][0] && words[i][0].match(/[A-Za-z]/))
			words[i] = words[i].replace(new RegExp(words[i][0]),words[i][0].toUpperCase());
	words = words.join(" ");
    words = words.replace(" S/s ","/");
    return words;
}

$(document).ready(function() {
    main = $("main");
    body = $("body");

    if (window.location.hash.length > 1){
		hasher();
	    window.onhashchange = hasher;
	}else{
	    $("[data-html]").each(function(i, div){
	        var url = div.getAttribute("data-html");
	        loader($("[data-html='"+url+"']"), url, initialize);
	    });
	}
	$('.nav a').on("click", function(event) {
	    if($(event.target).attr('class') != 'dropdown-toggle')
	        $('.navbar-collapse').collapse('hide');
	});
});

function initialize(){
    window.onhashchange = hasher;
}

function loader(div,url,cb) {
	div.empty();
    div.load(url, function(response, status, xhr) {
		if (cb && typeof cb === "function") cb(xhr); //Calls function argument passing the page xhr status
	});
}
