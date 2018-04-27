$(document).ready(function () {
    //Masks
    $('#data_nascimento').mask("00/00/0000")

    $('#telefone').mask("(00)0000-0000")
    /* // Mask para aceitar fixo e celular 
    $('#telefone').each(function (i, el) {
        $('#' + el.id).mask("(00) 00000-0000");
    })
    function updateMask(event) {
        var $element = $('#' + this.id);
        $(this).off('blur');
        $element.unmask();
        if (this.value.replace(/\D/g, '').length > 10) {
            $element.mask("(00) 00000-0000");
        } else {
            $element.mask("(00) 0000-00009");
        }
        $(this).on('blur', updateMask);
    }
    $('#telefone').on('blur', updateMask);
    */

    //Validações
    $.validator.addMethod("dateBR", function (value, element) {
        if (value.length != 10) return false;
        // verificando data           
        var data = value;
        var dia = value.substring(0, 2);
        var barra1 = value.substring(2, 3)
        var mes = data.substring(3, 5);
        var barra2 = value.substring(5, 6);
        var ano = data.substr(-4);
        if (data.length != 10 || barra1 != "/" || barra2 != "/" || isNaN(dia) || isNaN(mes) || isNaN(ano) || dia > 31 || mes > 12) return false;
        if ((mes == 4 || mes == 6 || mes == 9 || mes == 11) && dia == 31) return false;
        if (mes == 2 && (dia > 29 || (dia == 29 && ano % 4 != 0))) return false;
        if (ano < 1900) return false;
        return true;
    }, "Informe uma data válida");  // Mensagem padrão

    $.validator.addMethod("telefoneBR", function (value, element) {
        if (value.length < 13) return false;
        //retira todos os caracteres menos os numeros
        telefoneValida = value.replace(/\D/g, '');

        //verifica se tem a qtde de numero correto
        if (!(telefoneValida.length == 10)) return false;

        //verifica se não é nenhum numero digitado errado (propositalmente)
        for (var n = 0; n < 10; n++) {
            //um for de 0 a 9.
            //estou utilizando o metodo Array(q+1).join(n) onde "q" é a quantidade e n é o 	  
            //caractere a ser repetido
            if (telefoneValida == new Array(11).join(n) || telefoneValida == new Array(12).join(n)) return false;
        } 

        //DDDs validos
        var codigosDDD = [11, 12, 13, 14, 15, 16, 17, 18, 19,
            21, 22, 24, 27, 28, 31, 32, 33, 34,
            35, 37, 38, 41, 42, 43, 44, 45, 46,
            47, 48, 49, 51, 53, 54, 55, 61, 62,
            64, 63, 65, 66, 67, 68, 69, 71, 73,
            74, 75, 77, 79, 81, 82, 83, 84, 85,
            86, 87, 88, 89, 91, 92, 93, 94, 95,
            96, 97, 98, 99];

        //verifica se o DDD é valido 
        if (codigosDDD.indexOf(parseInt(telefoneValida.substring(0, 2))) == -1) return false;

        //8 caracteres numeros de telefone e radios (ex. Nextel)
        if (telefoneValida.length == 10 && [2, 3, 4, 5, 7].indexOf(parseInt(telefoneValida.substring(2, 3))) == -1) return false;

        return true;
    }, "Informe um telefone válido")


    $('#form').validate({
        rules: {
            nome: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            telefone: {
                required: true,
                telefoneBR: true
            },
            senha: {
                required: true,
                minlength: 5
            },
            confirma_senha: {
                required: true,
                equalTo: "#senha"
            },
            data_nascimento: {
                required: true,
                dateBR: true
            }
        },
        messages: {
            nome: {
                required: "Informe o seu nome.",
                minlength: "Preencha com ao menos 2 caracteres."
            },
            email: {
                required: "Informe um email.",
                email: "Informe um email válido."
            },
            telefone: {
                required: "Informe um número"
            },
            senha: {
                required: "Informe uma senha.",
                minlength: "Preencha com ao menos 5 caracteres."
            },
            confirma_senha: {
                required: "Confirme sua senha.",
                equalTo: "As senhas não batem"
            },
            data_nascimento: {
                required: "Informe uma data de nascimento"
            }
        }
    });
});