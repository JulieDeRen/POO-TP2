{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste des formats'})}}
        <table>
            <thead>
                <tr>
                    <th>Nom des format</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                {% for format in formats %}
                    {% if admin %}
                        <tr>
                            <td><a href="{{ path }}format/show/{{ format.id}}">{{ format.name }}</a></td>
                            <td><a href="{{ path }}format/show/{{ format.id}}">{{ format.description }}</a></td>
                        </tr>
                    {% else %}
                        <tr>
                            <td>{{ format.name }}</td>
                            <td>{{ format.description }}</td>
                        </tr>
                    {% endif %}
                {% endfor %}
                
            </tbody>
        </table>
    </main>
</body>
</html>