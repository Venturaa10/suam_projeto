// Mostra a seção desejada
function showSection(sectionId) {
  const sections = document.querySelectorAll(".conteudo");
  sections.forEach(function(section) {
    section.style.display = "none";
  });

  const target = document.getElementById(sectionId);
  if (target) {
    target.style.display = "block";
    window.scrollTo({ top: target.offsetTop, behavior: 'smooth' });
  }
}

// Executa após o DOM estar carregado
document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll("nav a[data-target]");
  const sections = document.querySelectorAll(".conteudo");

  // Esconde todas as seções inicialmente
  sections.forEach(function(section) {
    section.style.display = "none";
  });

  // Adiciona evento de clique aos itens do menu
  links.forEach(function(link) {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const targetId = this.getAttribute("data-target");
      showSection(targetId);
    });
  });
});
