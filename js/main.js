/* 
 * A page can't be manipulated safely until the document is "ready."
 * $( document ).ready() will only run once the page Document Object Model (DOM) is ready for JavaScript code.
 */
 
$(function() { // Shorthand for $(document).ready() with jQuery
    console.log( "DOM ready!" );


});