var url = location.origin; //"http://clubrs200.com.devel/";

window.addEventListener("load", function() {
    $(".btn-like").css("cursor", "pointer");
    $(".btn-dislike").css("cursor", "pointer");

    //Boton Like
    function like() {
        $(".btn-like")
            .unbind("click")
            .click(function() {
                $(this)
                    .addClass("btn-dislike")
                    .remove("btn-like");
                $(this).attr("src", url + "img/hearts-64-red.png");

                $.ajax({
                    url: url + "/like/" + $(this).data("id"),
                    type: "GET",
                    success: function(response) {
                        if (response.like) {
                            console.log("Has dado click en like");
                        } else {
                            console.log("Error al dar click");
                        }
                    }
                });

                dislike();
            });
    }
    like();

    //Boton Dislike
    function dislike() {
        $(".btn-dislike")
            .unbind("click")
            .click(function() {
                $(this)
                    .addClass("btn-like")
                    .remove("btn-dislike");
                $(this).attr("src", url + "img/hearts-64-gray.png");

                $.ajax({
                    url: url + "/dislike/" + $(this).data("id"),
                    type: "GET",
                    success: function(response) {
                        if (response.like) {
                            console.log("Has dado click en dislike");
                        } else {
                            console.log("Error al dar dislike");
                        }
                    }
                });

                like();
            });
    }
    dislike();

    //Busacador
    $("#buscarPiloto").submit(function(e) {
        //detener la ejecucion para ver en consola que realizo
        //e.preventDefault();

        $(this).attr("action", url + "/pilotos/" + $("#buscarPiloto #buscar").val());
    });

    //Busacador Convenios
    // $("#buscarConvenio").submit(function(e) {
    //     $(this).attr("action", url + "/convenios/" + $("#buscarConvenio #buscar").val());
    // });

    // $("#buscarPilotoConvenio").submit(function(e) {
    //     $(this).attr("action", url + "/convenios/buscar-piloto/" + $("#buscarPilotoConvenio #buscarPiloto").val());
    // });
});
