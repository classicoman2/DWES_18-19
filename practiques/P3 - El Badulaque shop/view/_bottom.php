</div>

<footer class="footer">
  <div class="container">
    <span class="muted">Llibreria Son Ferrer - Toni Amengual - 2018</span>
  </div>
</footer>

</body>
</html>

<script>
/**
 * En seleccionar en el Drop List d'Ordenació de Camps,
*    el llistat de llibres s'ordena pel camp corresponent
 * @return No
 */
function ordenaLlibres() {
   ordenacio = document.getElementById("ordenaLlibres").value;
   window.location.replace("index.php?controller=llibres&action=llista&ordre="+ordenacio);
}

/**
 * Actualitza la cistella de compra amb AJAX
 * @return No
 */
function actualitzaCistella(id) {
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("cistellablock").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "controller/ajax/afegirItemCistella.php?id="+id, true);
    xhttp.send();
}
    
</script>
