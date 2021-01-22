
var courseSelector = function(){
    jQuery(function ($) {
        console.log("triggered");
        var courses = $(".custom-course-wrapper");
        console.log(courses);
        $(courses).each(function(index,item){
            console.log("inside loop",index,item);
            var selectedCourse = $(".select-course-radio").find(".btn.active").data().toggle;
            let courseType =  $(item).data().coursetype;
            console.log(courseType);
            if(courseType !== selectedCourse  && courseType !== "allcourses" ){
                if ( $(item).css('display') == 'none' || $(item).css("visibility") == "hidden"){
                    $(item).toggle();
                }
            }
            if(courseType == selectedCourse){
                if ( $(item).css('display') == 'none' || $(item).css("visibility") == "hidden"){
                    $(item).toggle();
                }

            }

            if(courseType !== selectedCourse){
                $(item).toggle();

            }

            if(selectedCourse == "allcourses"){
                if ( $(item).css('display') == 'none' || $(item).css("visibility") == "hidden"){
                    $(item).toggle();
                }
            }





    });


    });
}

jQuery(function ($) {
$(document).ready(function () {

        $(".img-course-content img").click(function (event) {
            event.preventDefault();
            event.stopPropagation();
            console.log(event.target);
            let element = event.target
            let imgSource = $(element)[0].src;
            let courseContentWrapper = $(element).parent().siblings().children()[0]
            let courseHeaderText = $($(courseContentWrapper).find(".title-text")[0]).html()
            console.log(courseHeaderText);
            let courseTargetText = $($(courseContentWrapper).find(".target-text")[0]).html()
            console.log(courseTargetText);
            let courseDurationText =$($(courseContentWrapper).find(".duration-text")[0]).html()
            console.log(courseDurationText);
            let courseHtmlElement = $(element).parent().siblings().children()[1];
            let courseHtml = $(courseHtmlElement).html()
            $(".modal-course-img")[0].src = imgSource;
            console.log(imgSource);
            $(".modal-img-wrapper .modal-course-header").html(courseHeaderText);
            $(".modal-img-wrapper .target-text").html(courseTargetText);
            $(".modal-img-wrapper .duration-text").html(courseDurationText);
            $(".modal-course-features").html(courseHtml);
            $('#exampleModalLong').modal('show');
        });

    $('#radioBtn a').on('click', function(){
    // check what is selected
    var sel = $(this).data('title');
    // check its toggle
    var tog = $(this).data('toggle');
    console.log(tog);
    if(tog == "pte"){
        $('a[data-toggle='+"naati"+']').removeClass('active').addClass('notActive').attr("disabled", false);
        $('a[data-toggle='+"pte"+']').removeClass('notActive').addClass('active').attr("disabled", true);
        $('a[data-toggle='+"allcourses"+']').removeClass('active').addClass('notActive').attr("disabled", false);


    }
    if(tog == "naati"){
         $('a[data-toggle='+"naati"+']').removeClass('notActive').addClass('active').attr("disabled", true);
         $('a[data-toggle='+"pte"+']').removeClass('active').addClass('notActive').attr("disabled", false);
         $('a[data-toggle='+"allcourses"+']').removeClass('active').addClass('notActive').attr("disabled", false);

    }

    if(tog == "allcourses"){
         $('a[data-toggle='+"allcourses"+']').removeClass('notActive').addClass('active').attr("disabled", true);
         $('a[data-toggle='+"pte"+']').removeClass('active').addClass('notActive').attr("disabled", false);
         $('a[data-toggle='+"naati"+']').removeClass('active').addClass('notActive').attr("disabled", false);
    }



    courseSelector();

})
    });

    $(".join-now-button .btn").click(function(){
        console.log("button clicked");
        $("#contact-form-modal-new").show();
    })


    $("#contact-form-modal-new > div > div > div.modal-header > button").click(function(){
         $("#contact-form-modal-new").hide();
    })

    $('#exampleModalLong').on('hidden.bs.modal', function () {
        $("#contact-form-modal-new").hide();
});

});