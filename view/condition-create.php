{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Ajout condition'})}}
        <form action="{{ path }}condition/store" method = "post">
            <ul class="form-style-1">
                <li>
                    <label for = "name">Nom de la condition<span class="required">*</span></label>
                    <input type="text" name = "name" placeholder="Nom de la condition" class="field-long">
                </li>
                <li>
                    <label for = "description">Description<span class="required">*</span></label>
                    <textarea name="description" id="description" placeholder="Description de ce type de condition..." cols="30" rows="10" class="field-long"></textarea>
                </li>
                <li>
                    <input type="submit" value = "save">
                </li>
            </ul>          
        </form>
    </main>
</body>
</html>