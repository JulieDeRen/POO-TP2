{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Modifier'})}}
        <form action="{{ path }}format/update" method="post">
            <ul class="form-style-1">
                {% for format in formats %}
                <li>
                    <input type="hidden" name="id" value="{{format.id}}">
                </li>
                <li>
                    <label for="name">Nom du format</label>
                    <input type="text" name = "name" value="{{format.name}}" class="field-long">
                </li>
                <li>
                    <label for = "description">Description<span class="required">*</span></label>
                    <textarea name="description" id="description" cols="30" rows="10" class="field-long">{{format.description}}</textarea>
                </li>
                <li>
                    <input type="submit" value="Modifier">
                </li>
        </form>
        <form action="{{ path }}format/delete" method="post">
                <li>
                    <input type="hidden" name="id" value="{{format.id}}">
                </li>
                {% endfor %}
                <li>
                    <input type="submit" value="Effacer">
                </li>
            </ul>
        </form>
    </main>  
</body>
</html>
