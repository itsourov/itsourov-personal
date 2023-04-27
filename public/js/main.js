$('.faq-container button').on('click', function (event) {
    $(this).next().slideToggle(200, function () {
        $(this).parent().toggleClass('shadow', $(this).is(':visible'))
    })

});


// $(".tab-content:not(:first)").hide();
// $(".tab-btn:first").addClass('bg-primary-400 dark:bg-primary-400 text-white')
// $('.tab-btn').on('click', function (event) {
//     $('.tab-content').hide()
//     $('.tab-btn').removeClass('bg-primary-400 dark:bg-primary-400 text-white')
//     $(this).addClass('bg-primary-400 dark:bg-primary-400 text-white')
//     $('#' + $(this).attr('data-target')).show()
// });

document.addEventListener('livewire:load', function () {


    document.addEventListener('scroll-to-element', function (params) {

        let element = document.getElementById(params.detail.elementId);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
