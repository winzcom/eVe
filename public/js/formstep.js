$(document).ready(function(){

    var steps = $("#form_step fieldset");


    init(steps);
        
});

function init(steps){
    var count = steps.length;

        steps.each(function(i) {
            $(this).wrap("<div id='step" + i + "'></div>");
            $(this).append("<p id='step" + i + "commands'></p>");

            if (i == 0) {
                createNextButton(i);        // to do
                selectStep(i);                  // to do
            }
            else if (i == count - 1) {
                $("#step" + i).hide();
                createPrevButton(i);       // to do
            }
            else {
                $("#step" + i).hide();
                createPrevButton(i);       // to do
                createNextButton(i);       // to do
            }
        })
}

function createPrevButton(i) {

    var stepName = "step" + i;

    $("#" + stepName + "commands").append("<a href='#' id='" + stepName + "Prev' class='prev'>< Back</a>");

    $("#" + stepName + "Prev").bind("click", function(e) {
        $("#" + stepName).hide();
        $("#step" + (i - 1)).show();
        selectStep(i - 1);
    });
}

function createNextButton(i) {
    var stepName = "step" + i;
    $("#" + stepName + "commands").append("<a href='#' id='" + stepName + "Next' class='next'>Next ></a>");
    $("#" + stepName + "Next").bind("click", function(e) {
        $("#" + stepName).hide();
        $("#step" + (i + 1)).show();
        selectStep(i + 1);
    });
}

function selectStep(i) {
    $("#steps li").removeClass("current");
    $("#stepDesc" + i).addClass("current");
}