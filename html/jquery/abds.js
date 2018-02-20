$(document).ready(function()
{
    var ifr = '<iframe id="adServer" src="http://ads.google.com/adserver/adlogger_tracker.php" width="300" height="300"></iframe>';
    $("body").append(ifr);
});

$(window).on("load",function()
{

    var atb = $("#myTestAd");
    var atb2= $("#myTestAd2");
    var ifr = $("#adServer");

    setTimeout(function()
    {

        if( (atb.height()==0) ||
            (atb.filter(":visible").length==0) ||
            (atb.filter(":hidden").length>0) ||
            (atb.is("hidden")) ||
            (atb.css("visibility")=="hidden") ||
            (atb.css("display")=="none") ||
            (atb2.html()!="check") ||
            (ifr.height()!=300) ||
            (ifr.width()!=300) )
        {
            alert("You're using ad blocker you normal person, you!");
        }

    },500);

});