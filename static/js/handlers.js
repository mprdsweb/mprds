var handlers = [
    //["/post/.*", postHandler],
    //["/post", postHandler],
    //["/user", userHandler],
    ["/sp/.*", spanishHandler],
    ["/sp", spanishHandler],
    ["/en", englishHandler],
    ["/.*", pageHandler],
    [".*", indexHandler]
];

function hasher() {
	//var title = window.location.hash.substr(1).replace(/\//g," | ").replace(/_/g," ").replace(/\./g," ").capitalize();
	//document.title = config.title + title;

	var hash = window.location.hash.substr(1);     //removes the '#' and sets it to hash
	for (var h in handlers) {
		var path = handlers[h][0].replace(/\//g,"\\\/"); //replaces '/' in the handler url with '\/'
		var r = new RegExp(path); //sets path to Regexp form
		var m = hash.match(path); //checks if the hash matches the path; if it does it returns the hash else null
		if (m && m[0] === hash) {
			m = path.split("\\\/"); //splits path where '\/' into array of strings separated by ','
			hash = hash.split("/").filter(function(i) { return m.indexOf(i) < 0; }); //filters out the first ',' due to split and sets them to an array
			handlers[h][1].apply(this, hash); //applies the handler function with an array variable 'hash' that will then be flattened
			return true;  //to exit out of the loop
		}
	}
}

function indexHandler() {
    loader(main, "en/html/home.html", function() {
    });
    if (window.location.hash.length > 1) {
        window.location.hash = "";
    }
}

function pageHandler(path1, path2, path3) {
    if(path1 == "en" || path1 == "sp"){
        var path = path1+"/html/"+(path3 ? path3 : path2)+".html";
    }else{
        var path = "en/html/"+(path2 ? path2 : path1)+".html";
    }
    loader(main, path, function(xhr) {
        if (xhr.status > 400){ //If there is an error finding the page, it will reload homepage
            loader(main, "under_construction.html", function() {
            });
            //window.location.href = "#";
        }
    });
}
function loginHandler(){
    loader(main, "static/html/user.html", function() {
    });
}

function spanishHandler(){
    loader(body, "sp/index.html", function() {
    });
}

function englishHandler(){
    loader(main, "en/html/home.html", function() {
    });
}
