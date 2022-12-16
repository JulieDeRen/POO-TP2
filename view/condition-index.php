{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste de condition'})}}
        <table>
            <thead>
                <tr>
                    <th>Types de conditions</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                {% for condition in conditions %}
                    {% if admin %}
                        <tr>
                            <td><a href="{{ path }}condition/show/{{ condition.id }}">{{ condition.name }}</a></td>
                            <td><a href="{{ path }}condition/show/{{ condition.id }}">{{ condition.description }}</a></td>
                        </tr>
                    {% else %}
                        <tr>
                            <td>{{ condition.name }}</td>
                            <td>{{ condition.description }}</td>
                        </tr>
                    {% endif %}
                {% endfor %}
                
            </tbody>
        </table>
    </main>
</body>
</html>