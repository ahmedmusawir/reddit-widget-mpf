jQuery(document).ready(function($) {

  var adminContent = $( '.entry-content' );
  console.log( adminContent );

  adminContent.click( function(){

  	alert('Whadap!');
  	$( this ).css('background-color', 'dodgerblue')
  			 .css('color', 'white');

  });
	
});