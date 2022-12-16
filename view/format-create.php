{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Ajout format'})}}
        <form action="{{ path }}format/store" method = "post">
            <ul class="form-style-1">
                <li>
                    <label for = "name">Nom du format<span class="required">*</span></label>
                    <input type="text" name = "name" placeholder="Nom du format" class="field-long">
                </li>
                <li>
                    <label for = "description">Description<span class="required">*</span></label>
                    <textarea name="description" id="description" placeholder="Description du format..." cols="30" rows="10" class="field-long"></textarea>
                </li>
                <li>
                    <input type="submit" value = "save">
                </li>
            </ul>          
        </form>
    </main>
</body>
</html>