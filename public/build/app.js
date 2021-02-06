(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! core-js/modules/es.function.bind */ "./node_modules/core-js/modules/es.function.bind.js");

/* --js Celine--*/
$(function () {
  $('a.page-scroll').bind('click', function (event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
  });
}); // Highlight the top nav as scrolling occurs

$('body').scrollspy({
  target: '.navbar-fixed-top'
}); // Closes the Responsive Menu on Menu Item Click

$('.navbar-collapse ul li a').click(function () {
  $('.navbar-toggle:visible').click();
});

/***/ })

},[["./assets/js/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIl0sIm5hbWVzIjpbIiQiLCJiaW5kIiwiZXZlbnQiLCIkYW5jaG9yIiwic3RvcCIsImFuaW1hdGUiLCJzY3JvbGxUb3AiLCJhdHRyIiwib2Zmc2V0IiwidG9wIiwicHJldmVudERlZmF1bHQiLCJzY3JvbGxzcHkiLCJ0YXJnZXQiLCJjbGljayJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7QUFBQTtBQUNBQSxDQUFDLENBQUMsWUFBVztBQUNUQSxHQUFDLENBQUMsZUFBRCxDQUFELENBQW1CQyxJQUFuQixDQUF3QixPQUF4QixFQUFpQyxVQUFTQyxLQUFULEVBQWdCO0FBQzdDLFFBQUlDLE9BQU8sR0FBR0gsQ0FBQyxDQUFDLElBQUQsQ0FBZjtBQUNBQSxLQUFDLENBQUMsWUFBRCxDQUFELENBQWdCSSxJQUFoQixHQUF1QkMsT0FBdkIsQ0FBK0I7QUFDM0JDLGVBQVMsRUFBRU4sQ0FBQyxDQUFDRyxPQUFPLENBQUNJLElBQVIsQ0FBYSxNQUFiLENBQUQsQ0FBRCxDQUF3QkMsTUFBeEIsR0FBaUNDO0FBRGpCLEtBQS9CLEVBRUcsSUFGSCxFQUVTLGVBRlQ7QUFHQVAsU0FBSyxDQUFDUSxjQUFOO0FBQ0gsR0FORDtBQU9ILENBUkEsQ0FBRCxDLENBVUE7O0FBQ0FWLENBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVVcsU0FBVixDQUFvQjtBQUNoQkMsUUFBTSxFQUFFO0FBRFEsQ0FBcEIsRSxDQUlBOztBQUNBWixDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QmEsS0FBOUIsQ0FBb0MsWUFBVztBQUMzQ2IsR0FBQyxDQUFDLHdCQUFELENBQUQsQ0FBNEJhLEtBQTVCO0FBQ0gsQ0FGRCxFIiwiZmlsZSI6ImFwcC5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qIC0tanMgQ2VsaW5lLS0qL1xyXG4kKGZ1bmN0aW9uKCkge1xyXG4gICAgJCgnYS5wYWdlLXNjcm9sbCcpLmJpbmQoJ2NsaWNrJywgZnVuY3Rpb24oZXZlbnQpIHtcclxuICAgICAgICB2YXIgJGFuY2hvciA9ICQodGhpcyk7XHJcbiAgICAgICAgJCgnaHRtbCwgYm9keScpLnN0b3AoKS5hbmltYXRlKHtcclxuICAgICAgICAgICAgc2Nyb2xsVG9wOiAkKCRhbmNob3IuYXR0cignaHJlZicpKS5vZmZzZXQoKS50b3BcclxuICAgICAgICB9LCAxNTAwLCAnZWFzZUluT3V0RXhwbycpO1xyXG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICB9KTtcclxufSk7XHJcblxyXG4vLyBIaWdobGlnaHQgdGhlIHRvcCBuYXYgYXMgc2Nyb2xsaW5nIG9jY3Vyc1xyXG4kKCdib2R5Jykuc2Nyb2xsc3B5KHtcclxuICAgIHRhcmdldDogJy5uYXZiYXItZml4ZWQtdG9wJ1xyXG59KVxyXG5cclxuLy8gQ2xvc2VzIHRoZSBSZXNwb25zaXZlIE1lbnUgb24gTWVudSBJdGVtIENsaWNrXHJcbiQoJy5uYXZiYXItY29sbGFwc2UgdWwgbGkgYScpLmNsaWNrKGZ1bmN0aW9uKCkge1xyXG4gICAgJCgnLm5hdmJhci10b2dnbGU6dmlzaWJsZScpLmNsaWNrKCk7XHJcbn0pOyJdLCJzb3VyY2VSb290IjoiIn0=



// --------page photo detail---------
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});

