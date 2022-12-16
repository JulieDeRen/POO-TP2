{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste de client'})}}
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse</th>
                            <th>Anniversaire</th>
                            <th>Courriel</th>
                            <th>Pays</th>
                            <th>Privilège</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for client in clients %}
                        <tr>
                            <td><a href="{{ path }}client/show/{{ client.id}}">{{ client.firstName }}</a></td>
                            <td><a href="{{ path }}client/show/{{ client.id}}">{{ client.lastName }}</a></td>
                            <td><a href="{{ path }}client/show/{{ client.id}}">{{ client.addresse }}</a></td>
                            <td><a href="{{ path }}client/show/{{ client.id}}">{{ client.birthday }}</a></td>
                            <td><a href="{{ path }}client/show/{{ client.id}}">{{ client.email }}</a></td>
                            <td><a href="{{ path }}client/show/{{ client.id}}">{{ client.countryName }}</a></td>
                            <td><a href="{{ path }}client/show/{{ client.id}}">{{ client.type }}</a></td>
                        </tr>
                        {% endfor %}
                    </tbody>
                    
                </table>
            </section>
        </main>
        <footer>
            Tous les droits
        </footer>
    </body>
</html>