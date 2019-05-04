async function removeItem(item) {
    $(item).fadeOut();
    await wait(1000);
    $(item).remove();
}

function wait(time) {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve();
        }, time);
    });
}

function validateField(item) {
    var value = item.val();
    var type = item.attr("type");
    var invalid = false;

    if (value !== "") { //imposta il nome del campo visibile o invisibile se c'è del testo o no
        item.parent().addClass("before-visible");
    } else if (value === "") {
        item.parent().removeClass("before-visible");
    }

    if (type === "text") {
        if (value === "") { //text validator
            invalid = true;
        }
    } else if (type === "email") {
        if (value === "") { //email validator
            invalid = true;
        }
    } else if (type === "password") {
        if (value === "") { //email validator
            invalid = true;
        }
    } else if (type === "address") {
        if (value === "") { //email validator
            invalid = true;
        }
    }
    if (type === "date") {
        if (value === "") { //text validator
            invalid = true;
        }
    } else if (type === "file") {
        if (value === "") { //email validator
            invalid = true;
            item.siblings().addClass("invalid"); // perche bootstrap usa un contenitore con l'input e il div di output quindi inserisco invalid a tutti i siblings (override del metodo sotto)
        } else {
            item.siblings().removeClass("invalid");
        }
    } else if (type === "select") {
        if (value === "") { //email validator
            invalid = true;
            item.siblings().addClass("invalid"); // perche bootstrap usa un contenitore con l'input e il div di output quindi inserisco invalid a tutti i siblings (override del metodo sotto)
        } else {
            item.siblings().removeClass("invalid");
        }
    } //else if(type === ""){ //other validator
    //  
    //}
    if (invalid) {
        if (item.parent().parent().find(".invalidButton").length === 0) { // controllo se non ce gia un altro alert
            item.addClass("invalid");
            item.parent().parent().prepend("<label class='invalidButton fa fa-exclamation float-icon waves-circle waves-float bg-danger op-0-6 invalidIcon' for=" + item.attr("id") + " onclick='removeItem(this);'></label>");
        }
        event.preventDefault(); //blocco l'invio del form
        return false;
    } else {
        removeItem(item.parent().parent().find(".invalidButton")); //rimuove tutti gli alert del input box selezionato se il testo e valido
        item.removeClass("invalid");
        return true;
    }
    //alert("OK");
}

jQuery.document_ready (function() {
    //init Waves mode for compoent
    Waves.attach('.btn'); //, ['waves-button', 'waves-float', 'waves-purple']
    //Waves.attach('.float-icon');
    Waves.init();


    $('[data-toggle="tooltip"]').tooltip()

    $(".validate").on("change paste keyup select", function() { //hadler for event on input field
        validateField($(this));
    });

    $('.md-select ul li').on('click', function() {
        setTimeout(
            function() {
                validateField($(".md-select"));
            },
            100);
    });

    $('input[type="file"]').on('change', function() {
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(this).siblings(".custom-file-label").text(filename);
    });

});
