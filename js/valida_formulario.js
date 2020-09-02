function cadastraEditaEleicao(form_eleicao){
    if(form_eleicao == 'novo_eleicoes'){
        var ds_eleicao = document.novo_eleicoes.ds_eleicao.value;
        var ano        = document.novo_eleicoes.ano.value;
        var dt_votacao = document.novo_eleicoes.dt_votacao.value;
        var cd_taxa    = document.novo_eleicoes.cd_taxa.value;
    }
    else{
        var ds_eleicao = document.edita_eleicao.ds_eleicao.value;
        var ano        = document.edita_eleicao.ano.value;
        var dt_votacao = document.edita_eleicao.dt_votacao.value;
        var cd_taxa    = document.edita_eleicao.cd_taxa.value;
    }
    var data = /^(((0[1-9]|[12][0-9]|3[01])([-.\/])(0[13578]|10|12)([-.\/])(\d{4}))|(([0][1-9]|[12][0-9]|30)([-.\/])(0[469]|11)([-.\/])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([-.\/])(02)([-.\/])(\d{4}))|((29)(\.|-|\/)(02)([-.\/])([02468][048]00))|((29)([-.\/])(02)([-.\/])([13579][26]00))|((29)([-.\/])(02)([-.\/])([0-9][0-9][0][48]))|((29)([-.\/])(02)([-.\/])([0-9][0-9][2468][048]))|((29)([-.\/])(02)([-.\/])([0-9][0-9][13579][26])))$/;  
    var filter_ano = /^[0-9]{4}/;

    dt_votacao = dt_votacao.replace(/[^\d]+/g,'');

    if(ds_eleicao == ""){
        alert("Informe o campo descri\u00e7\u00e3o!");
    }
    else if(ano == ""){
        alert("Informe o campo ano!");
    }
    else if(!filter_ano.test(document.getElementById("ano").value)){
            alert('Por favor, digite o campo ano corretamente!');
            document.getElementById("ano").focus();
            return false;
    }        
    else if(dt_votacao == ""){
        alert("Informe o campo data de vota\u00e7\u00e3o!");
    }
    else if(dt_votacao != "" && !data.test(document.getElementById("dt_votacao").value)){
        alert('Por favor, verifique se a data da vota\u00e7\u00e3o \u00e9 uma data v\u00e1lida!' );
        document.getElementById("dt_votacao").focus();
            return false;
    }
    else if(cd_taxa == ""){
        alert("Informe o campo taxa!");
    }
    else if(form_eleicao == 'novo_eleicoes'){
        document.novo_eleicoes.submit();
    }
    else{
        document.edita_eleicao.submit();
    }
}


