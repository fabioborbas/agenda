$(document).ready(function () {
  carregarPagina(1);
  $("#select-list").change(atulizarItemPorPagina);
});
function atulizarItemPorPagina() {
  const itemPorPagina = $("#select-list").val();
  $("#itemPorPagina").val(itemPorPagina);
  carregarPagina(1);
  console.log("select?", itemPorPagina);
}

function carregarPagina(pagina) {
  $("#itemPorPagina").val();
  $.ajax({
    url: "carregar_pagina.php",
    type: "GET",
    data: {
      pagina: pagina,
    },
    success: function (response) {
      const res = JSON.parse(response);
      console.log(res.totalRegistros);
      carregarLista(res.data);
    },
    error: function () {
      alert("Erro ao carregar a página.");
    },
  });
}

function pegar_dados(id, nome) {
  console.log("entra?");
  console.log("ID:", id);
  console.log("Nome:", nome);

  // Define os valores nos elementos HTML dentro da modal
  document.getElementById("nome_contato").innerHTML = nome;
  document.getElementById("idcontatos").value = id;
}

function carregarLista(contatos) {
  const lista = $(".table tbody");
  lista.empty();
  contatos.forEach(function (contato) {
    const linha = $("<tr>");
    linha.append($("<td>").text(contato.nome));
    linha.append($("<td>").text(contato.telefone));
    linha.append($("<td>").text(contato.email));
    linha.append(
      $("<td>").html(`
        <a
          href='pages/cadastro_edit.php?id=${contato.idcontatos}'
          class='btn btn-success btn-sm'
          >Editar
        </a>
        <a
        href='#' 
        class='btn btn-danger btn-sm' 
        data-toggle='modal' 
        data-target='#modal_confirma'
        onclick='pegar_dados(${contato.idcontatos}, "${contato.nome}")'
    >
        Excluir
    </a>
   `)
    );

    lista.append(linha);
  });
}

function pagination() {}
