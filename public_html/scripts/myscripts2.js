// This is script is used for main page for new applicant and update applicant.
// Filter table

// $(document).ready(function(){
//   $("#tableSearch").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });

/*New code*/

// var options = [];

// $( '.dropdown-menu a' ).on( 'click', function( event ) {

//    var $target = $( event.currentTarget ),
//        val = $target.attr( 'data-value' ),
//        $inp = $target.find( 'input' ),
//        idx;

//    if ( ( idx = options.indexOf( val ) ) > -1 ) {
//       options.splice( idx, 1 );
//       setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
//    } else {
//       options.push( val );
//       setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
//    }

//    $( event.target ).blur();
      
//    console.log( options );
//    return false;
// });


// $(document).ready(function() {
//    $("#sort").DataTable({
//       columnDefs : [
//     { type : 'date', targets : [3] }
// ],  
//    });
// });

// Used for other education type.




// $(document).ready(function() {
//     $("input[name=othersDoc]").change(function() {
//         $(this).closest("li").find("input[name^=mileage]").attr("disabled", !this.checked);
//     });
// });   
