{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Ajouter pays'})}}
        <form action="{{ path }}country/store" method = "post">
            <ul class="form-style-1">
                <li>
                    <label for = "countryName">Nom du pays<span class="required">*</span></label>
                    <input type="text" name = "countryName" placeholder="Nom du pays" class="field-long">
                </li>
                <li>
                    <input type="submit" value = "save">
                </li>
            </ul>          
        </form>
    </main>
</body>
</html>