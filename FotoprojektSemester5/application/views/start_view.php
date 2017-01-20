<section class="section-white" style="margin: 3.25rem 0rem 0rem 0rem;">

	<div id="carousel-example-generic" class="carousel slide float-md-left" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div class="bild" style="background-image: url(<?php
				echo base_url ();
				?>_sonstiges/img/bild2.jpg)"></div>
			</div>
			<div class="carousel-item">
				<div class="bild" style="background-image: url(<?php
				
				echo base_url ();
				?>_sonstiges/img/bild3.jpg)"></div>
				<!-- 				<div class="carousel-caption"> -->
				<!-- 					<h2>Heading</h2> -->
				<!-- 				</div> -->
			</div>
			<div class="carousel-item">
				<div class="bild" style="background-image: url(<?php
				
				echo base_url ();
				?>_sonstiges/img/bild1.jpg)"></div>
				<!-- 				<div class="carousel-caption"> -->
				<!-- 					<h2>Heading</h2> -->
				<!-- 				</div> -->
			</div>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="icon-prev" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="icon-next" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-10 offset-md-1 col-xs-10 offset-xs-1 ui-widget">
			<input type="text" id="searchEvent" class="form-control" onkeyup="" placeholder="Search for event..." style="margin: 1.25rem 0.625rem" />
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div id="wrong_code" class="col-md-4 offset-md-4" role="alert" align="center"><?php
		
		echo $this->session->flashdata ( 'wrong_code' );
		?></div>
	</div>
</div>



<div class="album text-muted">
	<h1 class="text-xs-center">Events</h1>
	<div class="container">
		<div class="row">
			<div id="result">
			<?php
			foreach ( $events as $event ) {
				// Produkte aus Event in $products zwischenspeichern
				$products = $event->products_pbl;
				
				echo "<div class=\"col-lg-4 col-md-6 col-sm-6 col-xs-12 mycard\">";
				echo "<div class=\"lazyload\">";
				echo "<!--";
				echo "<div class=\"card-block\">";
				echo "<h4 class=\"card-title\"><a href=\"" . base_url () . "event/" . $event->even_url . "/\">" . $event->even_name . "</a></h4>";
				echo "</div>";
				echo "<a href=\"" . base_url () . "event/" . $event->even_url . "/\">";
				
				// 1. Bild des Events anzeigen ansonsten Platzhalter
				if (isset ( $products [0] )) {
					echo " <img class=\"img-responsive\" data-src=./" . $products [0]->prod_filepath . "\" alt=" . $products [0]->prod_name . "\"
						style=\"width:100%;height:280px; display: block;\"
						src=./" . $products [0]->prod_filepath . ">";
				} else {
					echo "<img data-src=\"holder.js/100px280/thumb\" alt=\"100%x280\"
						style=\"height: 280px; width: 100%; display: block;\"
						src=\"data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c79%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c79%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E\"
						data-holder-rendered=\"true\"> ";
				}
				
				echo "</a>";
				echo "-->";
				echo "</div>";
				echo "</div>";
			}
			?>
			</div>
			<img id="phimg" data-src="holder.js/100px280/thumb" alt="100%x280" style="height: 280px; width: 100%; display: none;"
				src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158b0639c79%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158b0639c79%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
				data-holder-rendered="true"> <br>
			<h4 id="noresults" style="text-align: center"></h4>
		</div>
	</div>
</div>

<button type="button" id="proof-btn" class="btn btn-success btn-md" data-toggle="modal" data-target="#proofModal" style="display: none"></button>

<!-- Modal -->
<div id="proofModal" class="modal-xl fade modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">

<?php

echo form_open ( "Start/checkCode", '' )?>

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<input type="text" class="form-control input-sm chat-input" placeholder="Bestätigungscode" id="event_code" name="event_code" /> <input
					type="hidden" value="" id="event_id" name="event_id"> <input type="hidden" value="" id="shortcode" name="shortcode">
			</div>


			<div class="modal-footer text-center">
				<div class="container">
					<div class="row">
						<div class="col-md-8 offset-md-2">
							<button type="submit" class="btn btn-success btn-md btn-block" role="button" id="send_code">Absenden</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		
		echo form_close ()?>
	</div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
echo '<script>';
echo '$( function() { var availableTags = [';
foreach ( $allevents as $e ) {
	echo "\"" . $e->even_name . "\",";
}
echo ']; $( "#searchEvent" ).autocomplete({ source: availableTags }); } );';
echo '</script>';

?>

<script type="text/javascript">  
var old = '';


    
    document.getElementById("searchEvent")
    	.addEventListener("keyup", function(event) {
    	event.preventDefault();
		    if (event.keyCode == 13) {
		        var search = document.getElementById('searchEvent').value;
                
                if(search.length > 0 && search !== ' ' && search !== old){
                    resetEvents();
                    searchEvent(search);
                    old = search;
                }
		    }
	});  
    	

    // Sucht per Ajax nach Events
function searchEvent(ev){
    $.ajax({
    		  type: "POST",
    		  url: "<?php
								
								echo site_url ();
								?>/Start/search/"+ev,
    		  dataType: 'html',
    		  success:function(data){
    			  try{  
    				  //console.log(data);
    				   var response = jQuery.parseJSON(data);

    				   var events = response.events;
        
                        if(events.length <= 0){
                            noresults(ev);
                        } else {

                           for (var i in events){
                               if(events[i].products.length > 0){
                                    ceateEvent(events[i].even_name, events[i].even_url, createPic(events[i].products[0].prod_filepath ,events[i].products[0].prod_name, events[i].even_status, events[i].even_id));
                                } else {
                                    ceateEvent(events[i].even_name, events[i].even_url)
                                }
                            }
                    	}
    				   
    				  }catch(e) {  
    				   alert('Exception while request..' + e);
    				  }  
    				  },
    				  error: function(){      
    				   alert('Error while request..');
    				  }

    		});
    }

// Anzeige bei keinen vorhandenen Events 
function noresults(searchtext){
    document.getElementById('noresults').innerHTML = "Es konnten keine Events mit dem Namen \"" + searchtext +"\" gefunden werden!";
}    

// Prüft ein Event nach dem eingegebenen Code
function proofEvent(i, d){
    var ai = i.parentNode.parentNode;
    var url = ai.getAttribute("href");
    var hidden = document.getElementById('event_id');
    var shortcode = document.getElementById('shortcode');
    
    hidden.value = d;
    
    shortcode.value = url;
    
    ai.setAttribute("href", "#"+i.getAttribute("id"));
    
    var a = ai.parentNode.firstChild.firstChild.firstChild;
    
    a.setAttribute("href", "#"+i.getAttribute("id"));
    
    clickProofModal(url);
} 

function clickProofModal(url){
	document.getElementById('proof-btn').click();
	document.getElementById('send_code').setAttribute("href", '#');
}

// Erstellt das Bild mit allen Attributen
function createPic(prodfile, prodname, status, id){
    var count = 0;
    
    if(status == 2){
    	var i = document.createElement("I");
        var div = document.createElement("DIV");
		i.classList.add("fa");
        i.classList.add("fa-lock");
        //i.classList.add("fa-10x");
        i.style.fontSize = "17.5rem";
        i.style.display = "inline-block";
        i.style.width = "100%";
        i.style.textAlign = "center";
        i.setAttribute("aria-hidden","true");
        i.setAttribute("id", "place"+count);
        i.onclick = function(){proofEvent(this, id);};
        count++;
        
        div.appendChild(i);
        
        return div;
    } else {
        var img = document.createElement("IMG");
        
        img.setAttribute("data-src", "./"+prodfile);
        img.setAttribute("src", "./"+prodfile);
        img.style.filter = "blur(5px)";
        img.classList.add("img-responsive");
        img.setAttribute("alt", prodname);
        img.style.height = "280px";
        img.style.width = "100%";
        img.onmouseover = function(){show(this);};
        img.onmouseout = function(){notShow(this);};
        
        return img;
    }
}

// erstellt die Ansicht einer Karte eines Events
function ceateEvent(eventname, eventurl, img){
    // Div in welchem die Events angezeigt werden sollen
	var div = document.getElementById('result');
    
    // benötigte Elemente
    var col = document.createElement("DIV");
    var lazy = document.createElement("DIV");
    var script = document.createElement("SCRIPT");
    var cardblock = document.createElement("DIV");
    var h = document.createElement("H4");
    var a = document.createElement("A");
    var ai = document.createElement("A");
    var textA = document.createTextNode(eventname);
    //var kom = document.createTextNode("-->");
    
    // Elementen Klassen zuweisen
    col.className +="col-lg-4 col-md-6 col-sm-6 col-xs-12 mycard";
    lazy.classList.add("lazyload");
    cardblock.classList.add("card-block");
    h.classList.add("card-title");
    a.setAttribute("href", "event/"+eventurl+"/");
    ai.setAttribute("href", "event/"+eventurl+"/");
   // script.type = "text/lazyload";
    
    // Elemente aneinandere hängen    
    a.appendChild(textA);
    h.appendChild(a);
    cardblock.appendChild(h);
    
    if(img != null){
        ai.appendChild(img);
    } else {
        ai.appendChild(phimg());
    }
    
    //lazy.innerHTML = "<!--";
    lazy.appendChild(cardblock);
    lazy.appendChild(ai);
    //lazy.appendChild(kom);
    
    //lazy.appendChild(script);
    col.appendChild(lazy);
    
    div.appendChild(col);
}

// Test Bild, falls keine Bilder im Event vorhanden sind 
function phimg(){
    var img = document.getElementById("phimg").cloneNode(true);
    img.style.display = "block";
    return img;
}

//Events werden aus DIV entfernt  
function resetEvents(){
    var result = document.getElementById("result");
    while (result.firstChild) {
        result.removeChild(result.firstChild);
    }
    document.getElementById('noresults').innerHTML = "";
}

// Bilder im Carousel werden auf die Bildschirmgröße angepasst
	function setPics(){
		var w = window.innerWidth;
		var h;

		if(checkMobileOrTablet()){
			h = (w/100)*45;
		} else {
			w = w*0.99;
			h = (w/100)*30;
		}

		var car = document.getElementById("carousel-example-generic");
        var img = car.getElementsByClassName("bild");
        
        car.style.width = w+"px";
        car.style.height = h+"px";
        
        for(var i = 0; i<img.length; i++){
            img[i].style.width = w + "px";
            img[i].style.height = h + "px";
        }
	}

// Checkt ob es sich um eine Mobilesdevice handelt
	function checkMobileOrTablet() {
		  var check = false;
		  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
		  return check;
		};

		 window.onload = function(){
		        if(document.getElementById("wrong_code").innerHTML.length > 0){
		            document.getElementById("wrong_code").className="alert alert-danger";
		            }
		    }
	
    window.addEventListener('resize', setPics, false);
    window.addEventListener('load', setPics, false);
</script>

<svg xmlns="http://www.w3.org/2000/svg" width="356" height="280" viewBox="0 0 356 280" preserveAspectRatio="none"
	style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;">
	<defs>
	<style type="text/css"></style></defs>
	<text x="0" y="18" style="font-weight:bold;font-size:18pt;font-family:Arial, Helvetica, Open Sans, sans-serif">356x280</text></svg>