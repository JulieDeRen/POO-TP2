{{ include('header.php', {title: 'Vente de timbres', pageHeader: 'Liste de timbres'})}}
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix actuel</th>
                            <th>Estimation</th>
                            <th>Date d'émission</th>
                            <th>Description</th>
                            <th>Pays</th>
                            <th>Format</th>
                            <th>Condition</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for stamp in stamps %}
                        <tr>
                            {% if admin %}
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.stampName }}</a></td>
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.price }}</a></td>
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.priceEstimation }}</a></td>
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.date }}</a></td>
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.description }}</a></td>
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.countryName }}</a></td>
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.formatName }}</a></td>
                            <td><a href="{{ path }}stamp/show/{{ stamp.id}}">{{ stamp.conditionName }}</a></td>
                            {% else %}
                            <td>{{ stamp.stampName }}</td>
                            <td>{{ stamp.price }}</td>
                            <td>{{ stamp.priceEstimation }}</td>
                            <td>{{ stamp.date }}</td>
                            <td>{{ stamp.description }}</td>
                            <td>{{ stamp.countryName }}</td>
                            <td>{{ stamp.formatName }}</td>
                            <td>{{ stamp.conditionName }}</td>
                            {% endif %}

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