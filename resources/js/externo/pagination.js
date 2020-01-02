$('ul.pagination').hide();
$(function() {
    $('.infinite-scroll').jscroll({
        autoTrigger: true,
        padding: 0,
        nextSelector: '.pagination li.active + li a',
        contentSelector: 'div.infinite-scroll',
        callback: function() {
            $('ul.pagination').remove();
        }
    });
});
