function hover_bars() {
  document.getElementById("header_bars").style.transform = "rotate(90deg)";
}


function un_hover_bars() {
  document.getElementById("header_bars").style.transform = "rotate(0deg)";
}


//we need to use regular expression
function move_cards_container_to_the_left() {
  console.log(document.getElementById("moving-container").style.transform);
  if((document.getElementById("moving-container").style.transform) == ""){
    if (window.matchMedia("(max-width: 767.9px)").matches) {
      document.getElementById("moving-container").style.transform = "translateX(calc(10px - 50vw - 50% - 300px))";
    } else {
      document.getElementById("moving-container").style.transform = "translateX(-600px)";
    }
  }else {
    if(window.matchMedia("(max-width: 767.9px)").matches) {
      var main_value = document.getElementById("moving-container").style.transform;
  
      regex = /[0-9]+[p%v]/g;
      var values = main_value.match(regex);
  
      percent_value = values[0];
      px_value = values[1];
      viewport_width_value = values[2];
      
      percent_value = percent_value.replace(/.$/, "");
      px_value = px_value.replace(/.$/, "");
      viewport_width_value = viewport_width_value.replace(/.$/, "");
      
      percent_value = parseInt(percent_value);
      px_value = parseInt(px_value);
      viewport_width_value = parseInt(viewport_width_value);
      
      percent_value = percent_value*(-1) - 50;
      px_value = px_value*(-1) - 290;
      viewport_width_value = viewport_width_value*(-1) - 50;
  
      if(percent_value*(-1) <= 350 ) document.getElementById("moving-container").style.transform = "translateX(calc("+ px_value +"px + "+ viewport_width_value +"vw + "+ percent_value +"%))";
      else document.getElementById("moving-container").style.transform = "translateX(calc(0% + 0px + 0vw))";
    }
    else {
      var main_value = document.getElementById("moving-container").style.transform;
  
      regex = /[0-9]+p/;
      var px_value = main_value.match(regex);
      
      px_value = px_value[0].replace(/.$/, "");
      
      px_value = parseInt(px_value);
      
      px_value = px_value*(-1) - 600;
  
      if(px_value*(-1) <= 2500 ) document.getElementById("moving-container").style.transform = "translateX(calc("+ px_value +"px))";
      else document.getElementById("moving-container").style.transform = "translateX(0px)";
    }
  }
}


//we need to use regular expression
function move_cards_container_to_the_right() {
  if((document.getElementById("moving-container").style.transform) == "") {}
  else if(window.matchMedia("(max-width: 767.9px)").matches) {
    document.getElementById("moving-container").style.transform = "translateX(calc(0% + 0px + 0vw))";
  }
  else {
    document.getElementById("moving-container").style.transform = "translateX(0px)";
  }
}

function view_delete_account(){
  document.getElementById("delete-account").style.display = "block";
}
function hide_delete_account(){
  document.getElementById("delete-account").style.display = "none";
}