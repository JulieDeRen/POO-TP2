{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Les utilisateurs'})}}
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
                        {% for user in users %}
                        <tr>
                            <td><a href="{{ path }}user/show/{{ user.id}}">{{ user.firstName }}</a></td>
                            <td><a href="{{ path }}user/show/{{ user.id}}">{{ user.lastName }}</a></td>
                            <td><a href="{{ path }}user/show/{{ user.id}}">{{ user.addresse }}</a></td>
                            <td><a href="{{ path }}user/show/{{ user.id}}">{{ user.birthday }}</a></td>
                            <td><a href="{{ path }}user/show/{{ user.id}}">{{ user.email }}</a></td>
                            <td><a href="{{ path }}user/show/{{ user.id}}">{{ user.countryName }}</a></td>
                            <td><a href="{{ path }}user/show/{{ user.id}}">{{ user.type }}</a></td>
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