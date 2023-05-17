
function relogios(mostrahora) {
    try {
        $.ajax({
            url: '/assets/php/controller.php',
            method: 'POST',
            data: { mostrahora1: mostrahora },
            dataType: 'json'
        }).done(function (result) {
            $('#relogio1').text(result);
        });
    } catch (error) {
        $('#relogio1').text('');
    }
    try {
        $.ajax({
            url: '/assets/php/controller.php',
            method: 'POST',
            data: { mostrahora2: mostrahora },
            dataType: 'json'
        }).done(function (result) {
            $('#relogio2').text(result);
        });
    } catch (error) {
        $('#relogio2').text('');
    }
    try {
        $.ajax({
            url: '/assets/php/controller.php',
            method: 'POST',
            data: { mostrahora3: mostrahora },
            dataType: 'json'
        }).done(function (result) {
            $('#relogio3').text(result);
        });
    } catch (error) {
        $('#relogio3').text('');
    }
}
let mostrahora = $('.mostrahora').val();
setInterval(relogios, 800, mostrahora);

$("#fatForm").submit((e) => {
    e.preventDefault();
    let valFatorar = $('#numberFat').val();
    let fatForm = $('#fatForm').val();


    if (valFatorar == '') {
        Swal.fire({
            icon: 'error',
            title: 'Valor inválido',
            text: 'Insira um número natural para fatorar'
        });
    } else {
        $.ajax({
            url: '/assets/php/controller.php',
            method: 'POST',
            data: { valFatorar: valFatorar, fatForm: fatForm },
            dataType: 'json'
        }).done(function (result) {
            $('#numberFat').val('').attr('placeholder', valFatorar + '! = ' + result);
            $('#resultFat').val(result);
        });
    }
});

$("#msgForm").submit((e) => {
    e.preventDefault();
    let nome = $('#nome').val();
    let email = $('#email').val();
    let msg = $('#msg').val();
    let msgForm = $('#msgForm').val();

    if ((nome == '') || (email == '') || (msg == '')) {
        // if (nome == '') { $('#nome').addClass('preencha'); }
        Swal.fire({
            icon: 'info',
            title: 'Preencha',
            text: 'Todos campos devem ser preenchidos para enviar a mensagem.'
        });


    } else {
        try {
            $.ajax({
                url: '/assets/php/controller.php',
                method: 'POST',
                data: {
                    nome: nome,
                    email: email,
                    msg: msg,
                    msgForm: msgForm
                },
                dataType: 'json'
            });
        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Error!'
            });
        } finally {
            nome = nome.toLowerCase();
            nome = nome.split(' ')[0]
            nome = nome[0].toUpperCase() + nome.substr(1);
            Swal.fire({
                icon: 'success',
                title: 'Email enviado com Sucesso!',
                text: 'Obrigado pelo Contato, ' + nome + '!'
            });
        }
    }
});

$('#calcForm').on('submit', function (e) {
    e.preventDefault(); // para evitar o comportamento padrão de submit

    var action = $(document.activeElement).data('action');
    let a = $('#a').val();
    let b = $('#b').val();

    if (action == 'somar') {
        try {
            $.ajax({
                url: '/assets/php/controller.php',
                method: 'POST',
                data: { somar: '', a: a, b: b },
                dataType: 'json'
            }).done(function (result) {
                console.log(result);
                $('#resultCalc').val(result);
            });
        } catch (error) {
            $('#resultCalc').text('erro');
        }
        return;
    }
    if (action == 'subtrair') {
        try {
            $.ajax({
                url: '/assets/php/controller.php',
                method: 'POST',
                data: { subtrair: '', a: a, b: b },
                dataType: 'json'
            }).done(function (result) {
                console.log(result);
                $('#resultCalc').val(result);
            });
        } catch (error) {
            $('#resultCalc').text('erro');
        }
        return;
    }
    if (action == 'multiplicar') {
        try {
            $.ajax({
                url: '/assets/php/controller.php',
                method: 'POST',
                data: { multiplicar: '', a: a, b: b },
                dataType: 'json'
            }).done(function (result) {
                console.log(result);
                $('#resultCalc').val(result);
            });
        } catch (error) {
            $('#resultCalc').text('erro');
        }
        return;
    }
    if (action == 'dividir') {
        try {
            $.ajax({
                url: '/assets/php/controller.php',
                method: 'POST',
                data: { dividir: '', a: a, b: b },
                dataType: 'json'
            }).done(function (result) {
                console.log(result);
                $('#resultCalc').val(result);
            });
        } catch (error) {
            $('#resultCalc').text('erro');
        }
        return;
    }
});



























// $("#calcForm").submit((e) => {
//     e.preventDefault();
//     let calcForm = $('#calcForm').val();
//     let a = $('#a').val();
//     let b = $('#b').val();
//     if ((a == '') || (a == null)) { a = 0 };
//     if ((b == '') || (b == null)) { b = 0 };
//     $('#soma').on('submit',function (event) {
//         alert("Handler for `submit` called.");
//         event.preventDefault();
//     });


//     $.ajax({
//         url: '/assets/php/controller.php',
//         method: 'POST',
//         data: { a: a, b: b, calcForm: calcForm },
//         dataType: 'json'
//     }).done(function (result) {
//         $('#a').val('').attr('placeholder', "A : " + a);
//         $('#b').val('').attr('placeholder', "B : " + b);
//         $('#resultCalc').val(result);
//     });

// });
