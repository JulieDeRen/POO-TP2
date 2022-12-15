{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste des formats'})}}
    <main>
        <table>
            <thead>
                <tr>
                    <th>Identifiant client</th>
                    <th>Adesse ip</th>
                    <th>Date</th>
                    <th>Pages visitées</th>
                </tr>
            </thead>
            <tbody>
                {% for session in sessions %}
                        <tr>
                            <td>{{ session.idUser }}<a href="{{ path }}session/delete/{{ session.id}}"></a></td>
                            <td>{{ session.adresseIP }}<a href="{{ path }}session/show/{{ format.id}}"></a></td>
                            <td>{{ session.date }}<a href="{{ path }}session/delete/{{ session.id}}"></a></td>
                            <td>{{ session.pageVisited }}<a href="{{ path }}session/show/{{ format.id}}"></a></td>
                        </tr>
                {% endfor %}
                
            </tbody>
        </table>
    </main>
</body>
</html>