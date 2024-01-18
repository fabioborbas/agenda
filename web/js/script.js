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
          href='cadastro_edit.php?id={$id}'
          class='btn btn-success btn-sm'
          >Editar
        </a>
        <a
          href='#' 
          class='btn btn-danger btn-sm' 
          data-bs-toggle='modal' 
          data-bs-target='#modal_confirma'
          onclick='pegar_dados({$id}," . json_encode($contato['nome']) . ")'
          >Excluir
        </a>
   `)
    );

    lista.append(linha);
  });
}

function pagination() {}
