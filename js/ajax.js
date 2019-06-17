$(function () {
    
    ajaxSort();

    $(".search__input").bind("keyup", function () {
        ajaxSearch();
        openCart();
    });

    $(".increase").bind("click", function () {
        $(".increase").prop('disabled', true);
        $(".descending").prop('disabled', false);
        ajaxSort();
    });

    $(".descending").bind("click", function () {
        $(".descending").prop('disabled', true);
        $(".increase").prop('disabled', false);
        ajaxSort();
    });
    
    $(".form-input").bind("keyup", function (e) {
        if(e.target.value != ""){
            ajaxSort();
        }
    });

    $(".form-check").bind("click", function () {
        ajaxSort();
    });

    function ajaxSort() {
        $(".goods__wrapper").html("");
        $(".goods__wrapper").append("<div class=\"d-flex justify-content-center align-items-center w-100\"><img src=\"img/Animation.gif\" id=\"animation\"></div>");
        $.ajax({
            url: "sort.php",
            type: "GET",
            data: ({
                priceStart: $("#priceStart").val(),
                priceEnd: $("#priceEnd").val(),
                goodsOne: $("#goodsOne").prop("checked"),
                goodsTwo: $("#goodsTwo").prop("checked"),
                goodsThree: $("#goodsThree").prop("checked"),
                goodsFour: $("#goodsFour").prop("checked"),
                colorBlack: $("#colorBlack").prop("checked"),
                colorWhite: $("#colorWhite").prop("checked"),
                colorGrey: $("#colorGrey").prop("checked"),
                colorBlue: $("#colorBlue").prop("checked"),
                increase: $(".increase").is(':disabled'),
                descending: $(".descending").is(':disabled'),
            }),
            dataType: "html",
            success: function (data) {
                $("#header-search").css("display","none");
                $("#header-search").html("");
                $(".search__input").css("border-bottom-style","solid");
                document.documentElement.scrollTop="0";
                timer=setTimeout(() => {
                    if(data!=""){
                        $(".goods__wrapper").html(data);
                        let titles = document.querySelectorAll('.goods__title');
                        titles.forEach(function (item) {
                            if (item.textContent.length < 70) {
                                return;
                            } else {
                                const str = item.textContent.slice(0, 71) + '...';
                                item.textContent = str;
                            }
                        });
                        start ("./script.js");  
                    }else{
                        $(".goods__wrapper").html("");
                        $(".goods__wrapper").append("<div class=\"d-flex justify-content-center align-items-center w-100\"><h2>Нет товаров по указанным критериям</h2></div>");
                    }
                }, 750);
            }
        });
    }

    function ajaxSearch() {

        $.ajax({
            url: "search.php",
            type: "GET",
            data: ({
                searchInput: $(".search__input").val()
            }),
            dataType: "html",
            beforeSend: function () {

            },
            success: function (data) {

                if(data!=""){
                    $("#header-search").html(data);
                    $(".search__input").css("border-bottom-style","none");
                    $("#header-search").css("display","block");
                }else{
                    $("#header-search").css("display","none");
                    $(".search__input").css("border-bottom-style","solid");
                }
                start ("./script.js");
            }
        });
    }

    $('#register_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "register.php",
            type: "POST",
            data: $('#register_form').serialize(),
            success: function(response) {
                if(response == 1){
                    swal({
                        title: "Вы успешно зарегистрировались!",
                        icon: "success",
                        button: "Хорошо!",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                      }); 
                      start ("./script.js");
                      $('body').css("overflow","hidden");
                      let email = $('#register_form input[name="email"]').val(),
                          password = $('#register_form input[name="password"]').val();

                      $('#auth_form input[name="email"]').val(email);
                      $('#auth_form input[name="password"]').val(password);
                      $('#register_form .form-control').val("");
                }else if(response == 0){
                    swal({
                        title: "Указанный логин уже существует",
                        icon: "error",
                        button: "Исправить",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                      }); 
                }else if(response == -1){
                    swal({
                        title: "Логин может состоять только из букв английского алфавита и цифр",
                        icon: "error",
                        button: "Исправить",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                      }); 
                }else if(response == -2){
                    swal({
                        title: "Логин должен быть не меньше 3-х символов и не больше 30",
                        icon: "error",
                        button: "Исправить",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                      }); 
                }else if(response == -3){
                    swal({
                        title: "Логин должен состоять не только из цифр",
                        icon: "error",
                        button: "Исправить",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                      }); 
                }
            },
            error: function(response) {
            alert("error");
            }
        });
    });

    $('#auth_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "auth.php",
            type: "POST",
            data: $('#auth_form').serialize(),
            success:  function (data) {
                if (data == 1){
                    location.reload();
                }else if(data == 0){
                    swal({
                        title: "Неверный логин или пароль!",
                        icon: "error",
                        button: "Хорошо!",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                    }); 
                }
            }
        });
    });    
    
    $('#formCart').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "formalization.php",
            type: "POST",
            data: $('#formCart').serialize(),
            success:  function (data) {
                if(data == 1){
                    swal({
                        title: "Вы успешно оформили заказ!",
                        icon: "success",
                        button: "Хорошо!",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                    }); 
                }else if(data == 0){
                    swal({
                        title: "Для оформления заказа необходимо авторизоваться!",
                        icon: "error",
                        button: "Хорошо!",
                      })
                      .then((value) => {
                        if(value==true){
                            $('body').css("overflow","");
                        }
                    }); 
                }
                $('.cart').css("display","none");
                $('.nav__badge').text("0");
                $('.cart__total span').text("0");
                $('.empty').css("display","block");
                $('.cart__wrapper .goods__item').remove();
            }
        });
    });  

    $(".btn-warning").bind("click", function (e) {
        ajaxOrderSort();
    });
    ajaxOrderSort();
    function ajaxOrderSort() {
    $("#orderAll").html("");
    $("#orderAll").append("<div class=\"d-flex justify-content-center align-items-center w-100\"><img src=\"img/Animation.gif\" id=\"animation\"></div>");
    $.ajax({
        url: "sortOrder.php",
        type: "POST",
        data: ({
            numOrder: $("#numOrder").val(),
        }),
        dataType: "html",
        success: function (data) {
            document.documentElement.scrollTop="0";
            timer=setTimeout(() => {
                if(data!=""){
                    $("#orderAll").html(data); 
                }else{
                    if($("#numOrder").val() != ""){
                        $("#orderAll").html("");
                        $("#orderAll").append("<div class=\"d-flex justify-content-center align-items-center w-100 p-4\"><h2>У вас нет заказа с указанным номером</h2></div>");
                    }else{
                        $("#orderAll").html("");
                        $("#orderAll").append("<div class=\"d-flex justify-content-center align-items-center w-100 p-4\"><h2>У вас еще нет заказов</h2></div>");
                    };
                }
            }, 750);
        }
    });
    
}

})