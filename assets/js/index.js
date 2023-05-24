
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

function formEdit(id) {
    id = parseInt(id);
    if (id != null || id != '') {

        try {
            $.ajax({
                url: '/assets/php/controller.php',
                method: 'POST',
                data: { id: id },
                dataType: 'json'
            }).done(function (result) {
                $('#nomeItem').val(result['nome']);
                $('#precoItem').val(formatar(result['preco']));
                $('#update').val(id);
            });
        } catch (error) {
            console.log('error');
        }
    }
}

function Editar(nome, preco, id) {
    id = parseFloat(id);
    if ((nome != '' || nome != null) && (preco != '' || preco != null)) {
        try {
            $.ajax({
                url: '/assets/php/controller.php',
                method: 'POST',
                data: {
                    nome: nome,
                    preco: preco,
                    id: id,
                    update: '',
                },
                dataType: 'json'
            }).done(function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Editado!',
                    text: nome + ' Atualizado com sucesso',


                });
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: nome + ' Não foi atualiza adequadamente.'
            });
        }
    }
    else {
        console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaa");
    }
}

function formatar(n) {
    n = n.toString().replaceAll(",", ";");
    n = n.toString().replaceAll(".", ",");
    n = n.toString().replaceAll(";", ".");
    return n;
}

function ativarBotao(idBotao) {
    $(idBotao).fadeIn(2000).prop("disabled", false);
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

            if (result > 99999) {
                $('#resultFat').fadeOut(100).fadeIn(100).addClass('wi');
                if (result > 99999999999999) {
                    $('#resultFat').removeClass('wi');
                    $('#resultFat').addClass('wi2');
                }
            }

            else {
                $('#resultFat').removeClass('wi');
                $('#resultFat').removeClass('wi2');
            }

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

            nome = nome.toLowerCase();
            nome = nome.split(' ')[0]
            nome = nome[0].toUpperCase() + nome.substr(1);
            Swal.fire({
                icon: 'success',
                title: 'Email enviado com Sucesso!',
                text: 'Obrigado pelo Contato, ' + nome + '!'
            });

        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Error!'
            });
        } finally {
            $('#botaoMsg').fadeOut(2000).prop("disabled", true);
            setInterval(ativarBotao, 10000, '#botaoMsg');
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
                $('#resultCalc').val(formatar(result));
            });
        } catch (error) {
            $('#resultCalc').text(error);
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
                $('#resultCalc').val(formatar(result));
            });
        } catch (error) {
            $('#resultCalc').text(error);
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
                $('#resultCalc').val(formatar(result));
            });
        } catch (error) {
            $('#resultCalc').text(error);
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
                $('#resultCalc').val(formatar(result));
            });
        } catch (error) {
            $('#resultCalc').text(error);
        }
        return;
    }
});

$('.tabela').on('click', (e) => {
    e.preventDefault();
    var id = $(document.activeElement).data('action');
    formEdit(id);
})


$('#PTabela').on('submit', (e) => {
    e.preventDefault();
    let nome = $('#nomeItem').val();
    let preco = $('#precoItem').val();
    let id = $('#update').val();
    Editar(nome, preco, id);
});

