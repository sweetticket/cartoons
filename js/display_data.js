$( document ).ready(function() {

var $container = $('#data_container');
// init
$container.packery({
  isInitLayout: false,
  itemSelector: '.item',
  gutter: 7
});

var container = document.querySelector('#data_container');
var pckry = new Packery( container, {
  // options
  itemSelector: '.item',
  gutter: 7
});

});