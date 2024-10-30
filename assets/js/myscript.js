jQuery(function ($) {

    var slides = $('#master-slides').find('.elementor-inner-section');

    const para1 = document.createElement("a");
    para1.classList.add("master-navigation-arrow");
    para1.classList.add("fa");
    para1.classList.add("fa-angle-left");
    para1.setAttribute("id", "prev");
    const element1 = document.getElementById("master-slides");
    element1.appendChild(para1);
    $("#prev").click(function () {
        var n = -1;
        showSlides(slideIndex += n);
    });


    const para2 = document.createElement("a");
    para2.classList.add("master-navigation-arrow");
    para2.classList.add("fa");
    para2.classList.add("fa-angle-right");
    para2.setAttribute("id", "next");
    const element2 = document.getElementById("master-slides");
    element2.appendChild(para2);
    $("#next").click(function () {
        var n = 1;
        showSlides(slideIndex += n);
    });


    for(var j =1; j <= slides.length; j++){
        const para3 = document.createElement("li");
        // var id = "current"+ j;
        para3.classList.add("master-navigation-dots");
        para3.classList.add("dot");
        para3.classList.add("align");
        para3.setAttribute("id", j);
        const element3 = document.getElementById("master-slides");
        element3.appendChild(para3);
    }

    $(".dot").click(function () {
        var id = jQuery(this).attr("id");
        currentSlide(id);
    });

        var li = $("li.dot");
        var len = li.length;
        for(var i = 0; i < li.length; i+=len) {
            li.slice(i, i+len).wrapAll("<div style='text-align: center'></div>");
        }



    var slideIndex = 1;
    showSlides(slideIndex);


    function currentSlide(n) {
        showSlides(slideIndex = n);
    }


    function showSlides(n) {

        var dots = document.getElementsByClassName("dot");

        if (slides.length == 1) {

            console.log("CHECK 1", slides);
        } else if (slides.length >= 2) {

            console.log("CHECK 2", slides);

            if (n > slides.length) {
                slideIndex = 1
            }

            if (n < 1) {
                slideIndex = slides.length
            }


            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }



            for (j = 1; j < dots.length; j++) {
                dots[j].className = dots[j].className.replace(" active", "");
            }


            slides[slideIndex - 1].style.display = "block";

            dots[slideIndex-1].className += " active";


        }
    }

});
