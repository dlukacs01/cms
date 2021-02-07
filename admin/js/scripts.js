$(document).ready(function(){ // to make sure that our document has loaded (jQuery code)

	// CKEditor (wysiwyg) A tynimce nem fog kelleni, mert fizetős lett !!! a CKEditor open source = free to use
	ClassicEditor
	    .create( document.querySelector( '#body' ) ) //id from textarea (body)
	    .catch( error => {
	        console.error( error );
	    } );

    //REST OF THE CODE

    //alert('hello');

    /* checkboxes (bulk actions) */

    $('#selectAllBoxes').click(function(event){


    	if(this.checked) {

            //alert(event.type);

    		$('.checkBoxes').each(function(){

    			this.checked = true;                

    		});


    	} else {


    		$('.checkBoxes').each(function(){

    			this.checked = false;

    		});


    	}


    });

    /* checkboxes (bulk actions) */


    /* page LOADER */

    var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    $("body").prepend(div_box);

    $('#load-screen').delay(700).fadeOut(600, function(){
        $(this).remove();
    });

    /* page LOADER */

});

function loadUsersOnline() {

    $.get("functions.php?onlineusers=result", function(data){

        $(".usersonline").text(data);
        
    });

}

setInterval(function(){

    loadUsersOnline();

},500); /* fél másodpercenként meghívódik */