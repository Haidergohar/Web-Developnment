// var e = document.getElementById("ddlViewBy");
// var strUser = e.options[e.selectedIndex].value;
// console.log(strUser);

function print_trendings(){
    var e = document.getElementById("Item");
    var strItem = e.options[e.selectedIndex].value;
    console.log(strItem);
    if(strItem == "1"){
        trending_items("gifs");        
    } else if(strItem == "2"){
        trending_items("stickers");
    } 
}

function trending_items(selected_value) {
    var trending_url = "https://api.giphy.com/v1/"+ selected_value +"/trending?api_key=qMVn7hV57IPIAJrlRU27Jt42nn2irJha&limit=24&rating=G";
    console.log(trending_url);
    fetch(trending_url)
    .then(res => res.json())
    .then((content) => {
        console.log(content);
        // all_contents = new Array();
        all_carousel_container = "<h1 class='display-4 carousel-trending-items'>Trending "+ selected_value + "</h1><div id='all_elements' class='text-center'>";
        carousel_elements_container = "<div id='recipeCarousel' class='carousel slide w-100' data-ride='carousel'>";
        carousels_container = "<div class='carousel-inner w-100' role='listbox'>";
        all_contents = all_carousel_container + carousel_elements_container + carousels_container;
        for (i = 0; i < 20; i++) {
            if(i==0){
                var row = "<div class='carousel-item row no-gutters active'><div class='col-3 float-left'>";
                //document.getElementById("gifs").innerHTML+= row;
            } else if(i%4==0){
                var row = "</div><div class='carousel-item row no-gutters'><div class='col-3 float-left'>";
            } else{
                var row ="<div class='col-3 float-left'>";
            }
            
           
            var img_src = content.data[i].images.fixed_height.url;
            var create_image = "<img src="+img_src+" class='img-responsive' onclick='show_image(this)' alt='"+content.data[i].title+"'>";

            all_contents += row + create_image + "</div>";
       
        }
        
        end_row = "</div>";
        end_carousels_container = "</div>";
        carousel_prev_button = "<a class='carousel-control-prev' href='#recipeCarousel' role='button' data-slide='prev'><span class='carousel-control-prev-icon' aria-hidden='true'></span><span class='sr-only'>Previous</span></a>";
        carousel_next_button = "<a class='carousel-control-next' href='#recipeCarousel' role='button' data-slide='next'><span class='carousel-control-next-icon' aria-hidden='true'></span><span class='sr-only'>Next</span></a>";
        end_carousels_elements_container = "</div>";
        end_all_carousels_container = "</div>";
        all_contents += end_row + end_carousels_container + carousel_prev_button + carousel_next_button + end_carousels_elements_container + end_all_carousels_container;
        // console.log(all_contents);
        document.getElementById("gifs-carousel").innerHTML = all_contents; 

        // all_contents.forEach(add_items());

        // function add_items(item) {
        //     document.getElementById("gifs").innerHTML += item; 
        // }

    })
    .catch(err => {
        console.log(err);
    });
}

// search function

function search_func(item) {
    query = document.getElementById("search").value;
    //var api_key = "qMVn7hV57IPIAJrlRU27Jt42nn2irJha";
    var url = "https://api.giphy.com/v1/" + item + "/search?api_key=qMVn7hV57IPIAJrlRU27Jt42nn2irJha&q="+query+"&limit=75&offset=0&rating=G&lang=en";
    fetch(url)
        .then(res => res.json())
        .then((content) => {
            // console.log(content);
            // all_contents = new Array();
            all_contents = "<h1 class='display-4 search-items'>Search Result For: "+ query + ":" + "</h1><div id='all_elements' class='text-center'>";
            console.log(content.data.length);
            if(content.data.length <= 0){
                var err = "<h2 style='text-align:left; padding: 10px;'>No Result Found</h2></div>";
                all_contents += err;
                document.getElementById("gifs").innerHTML = all_contents; 
            } else{
                for (i = 0; i < content.data.length; i++) {
                    if(i==0){
                        var row = "<div class='row'><div class='col-md-4'>";
                        //document.getElementById("gifs").innerHTML+= row;
                    } else if(i%3==0){
                        var row = "</div><div class='row'><div class='col-md-4'>";
                        //document.getElementById("gifs").innerHTML+= row;
                    } else{
                        var row ="<div class='col-md-4'>";
                        //document.getElementById("gifs").innerHTML+= col;
                    }
                    if(i==50){
                        break;
                    }
                    var create_card = "<div class='card' style='width: 18rem;'>";
                    var img_src = content.data[i].images.fixed_height.url;
                    var create_image = "<img src="+img_src+" class='card-img-top' onclick='show_image(this)' id='"+i+"' alt='"+content.data[i].title+"'>";
    
                    var card_body = "<div class='card-body'>";
                    var img_title_src =  content.data[i].title;
                    var img_title = "<p class='card-text'>"+ img_title_src +"</p>";
                    
                    
                    var end_card = "</div></div></div>";
                    
                    var card = row + create_card + create_image + card_body + img_title + end_card;
    
                    all_contents += card;
    
                }
                all_contents += "</div>";
                console.log(all_contents);
                document.getElementById("gifs").innerHTML = all_contents; 
    
                // all_contents.forEach(add_items());
    
                // function add_items(item) {
                //     document.getElementById("gifs").innerHTML += item; 
                // }
    
            }
        })
        .catch(err => {
            console.log(err);
        });
}

function init_search(){
    var e = document.getElementById("Item");
    var strItem = e.options[e.selectedIndex].value;
    console.log(strItem);
    if(strItem == "1"){
        search_func("gifs");        
    } else if(strItem == "2"){
        search_func("stickers");
    } 
}

// calling trending
trending_items("gifs");

//search event
input = document.getElementById('search');
input.addEventListener("keyup", function(event) {
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
      // Cancel the default action, if needed
      event.preventDefault();
      // Trigger the button element with a click
      //document.getElementById("myBtn").click();
      init_search();
    }
  });
  

// show image func


function show_image(t){
    var a = document.getElementById('q');
    var b = t.getAttribute("src");
    var title = t.getAttribute("alt");
    url = 'image.html?img=' + encodeURIComponent(b) + "&title="+ encodeURIComponent(title);
    //url = b;
    
    document.location.href = url;
}