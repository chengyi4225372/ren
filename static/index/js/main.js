$(function () {
    //��ά�뷭ת
    $(".rent").click(function(){
        $("html,body").animate({scrollTop: 0}, 500);
        $(".confirm").slideDown(500);
    });
    $(".head").click(function(){
        $(".confirm").hide();
        $(this).siblings(".confirm").slideDown();
    });
    $(".sure").click(function(){
        $(this).parents(".confirm").hide();
        $(this).parents(".turn").toggleClass("rotate");
    });
    $(".cancel").click(function(){
        $(this).parents(".confirm").slideUp();
    });
    $(".qrc").click(function(){
        $(this).parents(".turn").toggleClass("rotate");
    });
    //ɸѡ
    $(".filter").click(function () {
        $(".select").slideToggle();
    });
    $(".close").click(function () {
        $(".select").slideToggle();
    });
    //����
    $(".search").click(function(){
        $(".wrap").hide();
        $(".ss").show();
    });
    $(".ss i").click(function(){
        $(".ss").hide();
        $(".wrap").show();
    });
    //����
    $(".address").click(function(){
        $(".city").slideToggle();
    });
    $(".hot a").click(function(){
        $(".city").slideToggle();
    });
    $(".close1").click(function () {
        $(".city").slideToggle();
    });
    //���ظ���
    $(".more").click(function(){
        $(".list-wrap").append($(".list").clone(true));
        //$(".list").clone().appendTo(".list-wrap");
    })
});