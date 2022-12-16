{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Modifier'})}}
        <form action="{{ path }}condition/update" method="post">
            <ul class="form-style-1">
                {% for condition in conditions %}
                <li>
                    <input type="hidden" name="id" value="{{condition.id}}">
                </li>
                <li>
                    <label for="name">Nom du type de condition</label>
                    <input type="text" name = "name" value="{{condition.name}}" class="field-long">
                </li>
                <li>
                    <label for = "description">Description<span class="required">*</span></label>
                    <textarea name="description" id="description" cols="30" rows="10" class="field-long">{{condition.description}}</textarea>
                </li>
                <li>
                    <input type="submit" value="Modifier">
                </li>
        </form>
        <form action="{{ path }}condition/delete" method="post">
                <li>
                    <input type="hidden" name="id" value="{{condition.id}}">
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
