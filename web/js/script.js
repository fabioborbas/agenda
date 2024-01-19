$(document).ready(function () {
  carregarPagina(1);

  $("#select-list").change(function () {
    const itensPorPagina = $(this).val();
    $("#itemPorPagina").val(itensPorPagina);
    carregarPagina(1);
  });
});

function carregarPagina(pagina) {
  const itensPorPagina = $("#select-list").val();

  $.ajax({
    url: "carregar_pagina.php",
    type: "GET",
    data: {
      pagina: pagina,
      registrosPorPagina: itensPorPagina,
    },
    success: function (response) {
      const res = JSON.parse(response);
      carregarLista(res.data);
      atualizarBarraNavegacao(res.paginaAtual, res.totalPaginas);
    },
    error: function () {
      alert("Erro ao carregar a p�gina.");
    },
  });
}

function atualizarBarraNavegacao(paginaAtual, totalPaginas) {
  const barraNavegacao = $("#pagination");
  barraNavegacao.empty();

  barraNavegacao.append(
    `<li class="page-item ${paginaAtual === 1 ? "disabled" : ""}">
      <a class="page-link" href="#" data-page="${paginaAtual - 1}">Anterior</a>
    </li>`
  );

  for (let i = 1; i <= totalPaginas; i++) {
    barraNavegacao.append(
      `<li class="page-item ${paginaAtual === i ? "active" : ""}">
        <a class="page-link" href="#" data-page="${i}">${i}</a>
      </li>`
    );
  }

  barraNavegacao.append(
    `<li class="page-item ${paginaAtual === totalPaginas ? "disabled" : ""}">
      <a class="page-link" href="#" data-page="${paginaAtual + 1}">Próximo</a>
    </li>`
  );

  $(".page-link").click(function (e) {
    e.preventDefault();
    const novaPagina = parseInt($(this).data("page"), 10);
    if (!isNaN(novaPagina)) {
      carregarPagina(novaPagina);
    }
  });
}
function pegar_dados(id, nome) {
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
