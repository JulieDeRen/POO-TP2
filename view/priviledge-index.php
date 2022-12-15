{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste de privilège'})}}
    <main>
        <table>
            <thead>
                <tr>
                    <th>Types de privilège</th>
                </tr>
            </thead>
            <tbody>
                {% for priviledge in priviledges %}
                        <tr>
                            <td><a href="{{ path }}priviledge/show/{{ priviledge.id }}">{{ priviledge.type }}</a></td>
                        </tr>
                {% endfor %}
                
            </tbody>
        </table>
    </main>
</body>
</html>